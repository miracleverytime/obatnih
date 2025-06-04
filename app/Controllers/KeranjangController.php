<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;
use App\Models\ObatModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class KeranjangController extends BaseController
{
public function index()
{
    $db = \Config\Database::connect();

    // Ambil data keranjang dan obat
    $keranjang = $db->table('keranjang')
        ->select('keranjang.id, keranjang.jumlah, obat.nama_obat, obat.gambar_obat, obat.harga_satuan, obat.deskripsi')
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

    // Simpan ke tabel keranjang terlebih dahulu
    $keranjangModel->insert([
        'id_obat'    => $id_obat,
        'nama_obat'  => $obat['nama_obat'],
        'jumlah'     => $jumlah
    ]);

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
    $obatModel->update($obat['id_obat'], [ // PASTIKAN nama primary key-nya 'id'
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

    if ($obat['stok'] < $keranjang['jumlah']) {
        return redirect()->back()->with('error', 'Stok obat tidak mencukupi untuk transaksi.');
    }

    $db = \Config\Database::connect();
    $db->transStart();

    // Kurangi stok obat
    $stokBaru = $obat['stok'] - $keranjang['jumlah'];
    $obatModel->update($obat['id_obat'], ['stok' => $stokBaru]);

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
        'item' => $item, // ganti dari 'keranjang' menjadi 'item'
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

}





