<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\ApotekerModel;
use App\Models\AdminModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class AdminController extends BaseController
{
    public function dashboard(): string
    {
        return view('admin/dashboard');
    }

    public function dataobat(): string
    {
        $obatModel = new ObatModel();
        $data['obat'] = $obatModel->findAll();
        return view('admin/dataobat', $data);
    }

    public function laporanp(): string
    {
        $transaksiModel = new TransaksiModel();
        $userModel = new UserModel();

        $transaksi = $transaksiModel->findAll();

        // Gabungkan dengan nama user
        $data['transaksi'] = array_map(function ($item) use ($userModel) {
            $user = $userModel->find($item['id_user']);
            $item['nama_user'] = $user['nama'] ?? 'Tidak diketahui';
            return $item;
        }, $transaksi);

        return view('admin/laporanpenjualan', $data);
    }

    public function tstaff(): string
    {
        $adminModel = new AdminModel();
        $apotekerModel = new ApotekerModel();

        $data['admin'] = $adminModel->findAll();
        $data['apoteker'] = $apotekerModel->findAll();

        return view('admin/tambahstaff', $data);
    }

    public function buatstaff()
    {
        $role = $this->request->getPost('role');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($role === 'admin') {
            $model = new AdminModel();
        } elseif ($role === 'apoteker') {
            $model = new ApotekerModel();
        } else {
            return redirect()->back()->with('error', 'Role tidak valid');
        }

        $model->insert($data);
        return redirect()->to(base_url('admin/tambahstaff'))->with('success', 'Staff berhasil ditambahkan');
    }

    public function membuatstaff()
    {
        return view('admin/buat_staff');
    }


    public function edit($id)
    {
        $model = new \App\Models\ObatModel();
        $obat = $model->find($id);

        if (empty($obat) || !is_array($obat)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Obat dengan ID $id tidak ditemukan.");
        }

        $data['obat'] = $obat;
        return view('admin/edit_obat', $data);
    }

    public function update($id): RedirectResponse
    {
        $obatModel = new ObatModel();
        $gambar = $this->request->getFile('gambar_obat');

        $data = [
            'nama_obat'       => $this->request->getPost('nama_obat'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
            'dosis'           => $this->request->getPost('dosis'),
            'komposisi'       => $this->request->getPost('komposisi'),
            'cara_pakai'      => $this->request->getPost('cara_pakai'),
            'kemasan'         => $this->request->getPost('kemasan'),
            'golongan_obat'   => $this->request->getPost('golongan_obat'),
            'kontra_indikasi' => $this->request->getPost('kontra_indikasi'),
            'efek_samping'    => $this->request->getPost('efek_samping'),
            'stok'            => $this->request->getPost('stok')
        ];

        // Jika user upload gambar baru
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $namaFile = $gambar->getRandomName();
            $gambar->move('assets/gambar', $namaFile);
            $data['gambar_obat'] = $namaFile;
        }

        $obatModel->update($id, $data);
        return redirect()->to(base_url('admin/dataobat'));
    }

    public function hapus($id)
    {
        $obatModel = new ObatModel();
        $obatModel->delete($id);
        return redirect()->to(base_url('admin/dataobat'));
    }

    public function hapusadmin($id)
    {
        $adminModel = new AdminModel();
        $adminModel->delete($id);
        return redirect()->to(base_url('admin/tambahstaff'));
    }

    public function hapusapoteker($id)
    {
        $apotekerModel = new ApotekerModel();
        $apotekerModel->delete($id);
        return redirect()->to(base_url('admin/tambahstaff'));
    }

    public function detail($id)
    {
        $model = new ObatModel();
        $data['obat'] = $model->find($id);

        if (!$data['obat']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/detail_obat', $data);
    }

    public function buat()
    {
        $obatModel = new ObatModel();

        $gambar = $this->request->getFile('gambar_obat');
        $namaFile = null;

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $namaFile = $gambar->getRandomName();
            $gambar->move('assets/gambar', $namaFile);
        }

        $obatModel->insert([
            'nama_obat' => $this->request->getPost('nama_obat'),
            'dosis' => $this->request->getPost('dosis'),
            'kemasan' => $this->request->getPost('kemasan'),
            'komposisi' => $this->request->getPost('komposisi'),
            'golongan_obat' => $this->request->getPost('golongan_obat'),
            'kontra_indikasi' => $this->request->getPost('kontra_indikasi'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'stok' => $this->request->getPost('stok'),
            'cara_pakai' => $this->request->getPost('cara_pakai'),
            'efek_samping' => $this->request->getPost('efek_samping'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar_obat' => $namaFile
        ]);

        return redirect()->to(base_url('admin/dataobat'));
    }


    public function membuatobat()
    {
        return view('admin/buat_obat');
    }
}
