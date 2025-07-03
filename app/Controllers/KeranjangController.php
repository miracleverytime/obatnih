<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;
use App\Models\ObatModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\PengirimanModel;
use CodeIgniter\HTTP\ResponseInterface;

class KeranjangController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Ambil data keranjang dan obat
        $keranjang = $db->table('keranjang')
            ->select('keranjang.id, keranjang.jumlah, obat.nama_obat, obat.gambar_obat, obat.harga_satuan, obat.deskripsi, obat.stok')
            ->join('obat', 'obat.id_obat = keranjang.id_obat')
            ->get()
            ->getResultArray();

        $subtotal = 0;
        foreach ($keranjang as $item) {
            $subtotal += $item['harga_satuan'] * $item['jumlah'];
        }

        // Ambil daftar obat (untuk select input)
        $obatModel = new \App\Models\ObatModel();
        $daftar_obat = $obatModel->findAll();

        return view('user/keranjang', [
            'keranjang'    => $keranjang,
            'daftar_obat'  => $daftar_obat,
            'subtotal'     => $subtotal,
        ]);
    }

    // Fungsi baru untuk update quantity via AJAX
    public function updateQuantity()
    {
        // Pastikan request adalah POST dan AJAX
        if (!$this->request->isAJAX() || !$this->request->is('post')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request'
            ]);
        }

        $id = $this->request->getPost('id');
        $jumlah = (int)$this->request->getPost('jumlah');

        // Validasi input
        if (!$id || $jumlah < 1 || $jumlah > 99999) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID atau jumlah tidak valid (1-99999)'
            ]);
        }

        $keranjangModel = new KeranjangModel();
        $obatModel = new ObatModel();

        // Ambil data keranjang saat ini
        $keranjang = $keranjangModel->find($id);
        if (!$keranjang) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Item tidak ditemukan di keranjang'
            ]);
        }

        // Ambil data obat
        $obat = $obatModel->find($keranjang['id_obat']);
        if (!$obat) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data obat tidak ditemukan'
            ]);
        }

        // Hitung selisih quantity
        $selisih = $jumlah - $keranjang['jumlah'];

        // Jika quantity bertambah, cek apakah stok mencukupi
        if ($selisih > 0 && $obat['stok'] < $selisih) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $obat['stok']
            ]);
        }

        // Mulai transaksi database
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update quantity di keranjang
            $keranjangModel->update($id, ['jumlah' => $jumlah]);

            // Update stok obat (kurangi stok jika quantity bertambah, tambah jika berkurang)
            $stok_baru = $obat['stok'] - $selisih;
            $obatModel->update($obat['id_obat'], ['stok' => $stok_baru]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal');
            }

            // Hitung subtotal baru
            $subtotal_baru = $this->hitungSubtotal();

            // Set header response sebagai JSON
            $this->response->setContentType('application/json');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Quantity berhasil diupdate',
                'data' => [
                    'jumlah' => $jumlah,
                    'total_item' => $jumlah * $obat['harga_satuan'],
                    'subtotal' => $subtotal_baru,
                    'stok_tersisa' => $stok_baru
                ]
            ]);
        } catch (\Exception $e) {
            $db->transRollback();

            // Set header response sebagai JSON
            $this->response->setContentType('application/json');

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate quantity: ' . $e->getMessage()
            ]);
        }
    }

    // Fungsi helper untuk menghitung subtotal (tetap sama)
    private function hitungSubtotal()
    {
        $db = \Config\Database::connect();
        $keranjang = $db->table('keranjang')
            ->select('keranjang.jumlah, obat.harga_satuan')
            ->join('obat', 'obat.id_obat = keranjang.id_obat')
            ->get()
            ->getResultArray();

        $subtotal = 0;
        foreach ($keranjang as $item) {
            $subtotal += $item['harga_satuan'] * $item['jumlah'];
        }

        return $subtotal;
    }

    public function tambah()
    {
        $id_obat = $this->request->getPost('id_obat');
        $jumlah = (int)$this->request->getPost('jumlah');

        if (!$id_obat || $jumlah <= 0) {
            return redirect()->back()->with('error', 'ID obat atau jumlah tidak valid.');
        }

        $obatModel = new \App\Models\ObatModel();
        $keranjangModel = new \App\Models\KeranjangModel();

        $obat = $obatModel->find($id_obat);

        if (!$obat) {
            return redirect()->back()->with('error', 'Obat tidak ditemukan.');
        }

        if ($jumlah > $obat['stok']) {
            return redirect()->back()->with('error', 'Stok obat tidak mencukupi.');
        }

        // Cek apakah obat sudah ada di keranjang
        $keranjang_existing = $keranjangModel->where('id_obat', $id_obat)->first();

        if ($keranjang_existing) {
            // Jika sudah ada, update quantity
            $jumlah_baru = $keranjang_existing['jumlah'] + $jumlah;

            if ($jumlah_baru > $obat['stok']) {
                return redirect()->back()->with('error', 'Total quantity melebihi stok yang tersedia.');
            }

            $keranjangModel->update($keranjang_existing['id'], [
                'jumlah' => $jumlah_baru
            ]);
        } else {
            // Jika belum ada, tambah baru
            $keranjangModel->insert([
                'id_obat'    => $id_obat,
                'nama_obat'  => $obat['nama_obat'],
                'jumlah'     => $jumlah
            ]);
        }

        // Kurangi stok di tabel obat
        $obatModel->update($id_obat, [
            'stok' => $obat['stok'] - $jumlah
        ]);

        return redirect()->back()->with('success', 'Obat berhasil ditambahkan ke keranjang.');
    }

    public function hapus($id)
    {
        if (!is_numeric($id)) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        $keranjangModel = new \App\Models\KeranjangModel();
        $obatModel = new \App\Models\ObatModel();

        // Cari item di keranjang
        $keranjang = $keranjangModel->find($id);
        if (!$keranjang) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
        }

        // Cari data obat berdasarkan ID obat yang ada di keranjang
        $obat = $obatModel->find($keranjang['id_obat']);
        if (!$obat) {
            return redirect()->back()->with('error', 'Data obat tidak ditemukan. Tidak bisa mengembalikan stok.');
        }

        // Mulai transaksi database
        $db = \Config\Database::connect();
        $db->transStart();

        // Tambahkan kembali stok obat
        $stok_baru = $obat['stok'] + $keranjang['jumlah'];
        $obatModel->update($obat['id_obat'], [
            'stok' => $stok_baru
        ]);

        // Hapus item dari keranjang
        $keranjangModel->delete($id);

        // Selesaikan transaksi
        $db->transComplete();

        // Cek apakah transaksi sukses
        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menghapus item dari keranjang. Silakan coba lagi.');
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dan stok obat diperbarui.');
    }

    public function checkout()
    {
        $db = \Config\Database::connect();

        // Ambil semua item di keranjang
        $keranjang = $db->table('keranjang')
            ->select('keranjang.id, keranjang.jumlah, keranjang.id_obat, obat.nama_obat, obat.harga_satuan')
            ->join('obat', 'obat.id_obat = keranjang.id_obat')
            ->get()
            ->getResultArray();

        if (empty($keranjang)) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        $transaksiModel = new TransaksiModel();
        $keranjangModel = new KeranjangModel();

        $db->transStart();

        try {
            $total_keseluruhan = 0;
            $waktu_transaksi = date('Y-m-d H:i:s');

            foreach ($keranjang as $item) {
                $total_item = $item['jumlah'] * $item['harga_satuan'];
                $total_keseluruhan += $total_item;

                // Simpan ke tabel transaksi
                $transaksiModel->insert([
                    'id_obat'     => $item['id_obat'],
                    'jumlah'      => $item['jumlah'],
                    'total_harga' => $total_item,
                    'tanggal'     => $waktu_transaksi,
                ]);

                // Hapus dari keranjang
                $keranjangModel->delete($item['id']);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi gagal');
            }

            return view('user/bayar_sukses', [
                'keranjang' => $keranjang,
                'total_keseluruhan' => $total_keseluruhan,
                'waktu' => $waktu_transaksi
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal memproses checkout: ' . $e->getMessage());
        }
    }

    public function bayar($id)
    {
        // Cek apakah request berupa POST
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Akses tidak valid.');
        }

        // Validasi ID
        if (!is_numeric($id)) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        $keranjangModel  = new \App\Models\KeranjangModel();
        $obatModel       = new \App\Models\ObatModel();
        $transaksiModel  = new \App\Models\TransaksiModel();

        $keranjang = $keranjangModel->find($id);
        if (!$keranjang) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
        }

        $obat = $obatModel->find($keranjang['id_obat']);
        if (!$obat) {
            return redirect()->back()->with('error', 'Obat tidak ditemukan. Tidak bisa diproses.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Hitung total dan waktu transaksi
        $waktuTransaksi = date('Y-m-d H:i:s');
        $totalHarga = $keranjang['jumlah'] * $obat['harga_satuan'];

        // Simpan ke tabel transaksi
        $transaksiModel->insert([
            'id_obat'     => $keranjang['id_obat'],
            'jumlah'      => $keranjang['jumlah'],
            'total_harga' => $totalHarga,
            'tanggal'     => $waktuTransaksi,
        ]);

        // Hapus dari keranjang
        $keranjangModel->delete($id);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memproses transaksi.');
        }

        return view('user/bayar_sukses', [
            'obat'        => $obat,
            'jumlah'      => $keranjang['jumlah'],
            'total_harga' => $totalHarga,
            'waktu'       => $waktuTransaksi
        ]);
    }

    public function edit($id)
    {
        $keranjangModel = new KeranjangModel();
        $obatModel = new ObatModel();

        // Ambil item keranjang berdasarkan ID
        $item = $keranjangModel->find($id);

        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Item keranjang dengan ID $id tidak ditemukan.");
        }

        $data = [
            'item' => $item,
            'daftar_obat' => $obatModel->findAll()
        ];

        return view('user/edit_keranjang', $data);
    }

    public function update($id)
    {
        $keranjangModel = new KeranjangModel();

        $data = [
            'nama_obat' => $this->request->getPost('nama_obat'),
            'jumlah'    => $this->request->getPost('jumlah'),
        ];

        $keranjangModel->update($id, $data);

        return redirect()->to(base_url('user/keranjang'))->with('success', 'Data keranjang berhasil diperbarui.');
    }

    public function detailPengiriman()
    {
        $keranjangModel = new KeranjangModel();
        $obatModel = new ObatModel();

        $userModel = new UserModel();
        $userId = session()->get('id');

        // Ambil satu user berdasarkan ID
        $data['user'] = $userModel->find($userId);

        $keranjang = $keranjangModel
            ->join('obat', 'obat.id_obat = keranjang.id_obat')
            ->select('keranjang.*, obat.nama_obat, obat.harga_satuan, obat.gambar_obat')
            ->findAll();

        $subtotal = array_reduce($keranjang, function ($carry, $item) {
            return $carry + ($item['jumlah'] * $item['harga_satuan']);
        }, 0);

        return view('user/detail_pengiriman', [
            'keranjang' => $keranjang,
            'subtotal' => $subtotal,
            'data' => $data,
        ]);
    }

    public function prosesPengiriman()
    {
        $request = \Config\Services::request();
        $session = session();
        $userId = $session->get('id');

        // Ambil input form
        $data = [
            'id_user'        => $userId,
            'nama'           => $request->getPost('nama') ?? $session->get('nama'),
            'alamat'         => $request->getPost('alamat') ?? $session->get('alamat'),
            'detail_alamat'  => $request->getPost('detail_alamat'),
            'provinsi'       => $request->getPost('provinsi'),
            'kota'           => $request->getPost('kota'),
            'kode_pos'       => $request->getPost('kode_pos'),
            'no_hp'          => $request->getPost('no_hp'),
            'tanggal'        => date('Y-m-d H:i:s')
        ];

        // Validasi simple
        if (empty($data['provinsi']) || empty($data['kota']) || empty($data['kode_pos'])) {
            return redirect()->back()->with('error', 'Harap lengkapi data pengiriman.');
        }

        $pengirimanModel = new \App\Models\PengirimanModel();
        $inserted = $pengirimanModel->insert($data);

        if ($inserted) {
            return redirect()->to('/user/pembayaran');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data pengiriman.');
        }
    }


    public function pembayaran()
    {
        $keranjangModel = new KeranjangModel();
        $obatModel = new ObatModel();

        $userModel = new UserModel();
        $userId = session()->get('id');

        // Ambil satu user berdasarkan ID
        $data['user'] = $userModel->find($userId);

        $keranjang = $keranjangModel
            ->join('obat', 'obat.id_obat = keranjang.id_obat')
            ->select('keranjang.*, obat.nama_obat, obat.harga_satuan, obat.gambar_obat')
            ->findAll();

        $subtotal = array_reduce($keranjang, function ($carry, $item) {
            return $carry + ($item['jumlah'] * $item['harga_satuan']);
        }, 0);

        return view('user/pembayaran', [
            'keranjang' => $keranjang,
            'subtotal' => $subtotal,
            'data' => $data,
        ]);
    }

    public function pembayaranProses()
    {
        $keranjangModel = new \App\Models\KeranjangModel();
        $transaksiModel = new \App\Models\TransaksiModel();
        $userId = session()->get('id');

        // Ambil data keranjang
        $keranjang = $keranjangModel
            ->join('obat', 'obat.id_obat = keranjang.id_obat')
            ->select('keranjang.*, obat.harga_satuan')
            ->findAll();

        if (empty($keranjang)) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung total harga
        $total = 0;
        foreach ($keranjang as $item) {
            $total += $item['jumlah'] * $item['harga_satuan'];
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Simpan data transaksi
            $transaksiModel->insert([
                'id_user'            => $userId,
                'tanggal_transaksi'  => date('Y-m-d'),
                'total_harga'        => $total,
                'status'             => 'pending', // default
            ]);

            // Hapus isi keranjang
            foreach ($keranjang as $item) {
                $keranjangModel->delete($item['id']);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi gagal disimpan.');
            }

            return redirect()->to('/user/katalog')->with('success', 'Pembayaran berhasil! Transaksi sedang diproses.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }
}
