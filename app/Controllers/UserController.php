<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ObatModel;


class UserController extends BaseController
{    

    protected $obatModel;
    
    public function __construct()
    {
        $this->obatModel = new ObatModel();
    }

    public function katalog(): string
    {
        $data['obat'] = $this->obatModel->findAll();
        
        return view('user/katalog', $data);
    }


    public function detailp($id)
    {
        // Ambil data obat berdasarkan ID
        $obat = $this->obatModel->getObat($id);
        
        // Cek apakah data obat ditemukan
        if (!$obat) {
            // Jika tidak ditemukan, redirect atau tampilkan error
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Obat dengan ID ' . $id . ' tidak ditemukan');
        }
        
        $data = [
            'obat' => $obat
        ];
        
        return view('user/detail_produk', $data); // sesuaikan path view Anda
    }

    public function profil()
{
    $userModel = new UserModel();
    $userId = session()->get('id');

    // Ambil satu user berdasarkan ID
    $data['user'] = $userModel->find($userId);

    return view('user/profil', $data);
}


    public function updateProfil($id)
{
    $userModel = new UserModel();
    $userId = session()->get('id');

    // Ambil input dari form
    $nama = $this->request->getPost('nama');
    $nama_akhir = $this->request->getPost('nama_akhir'); // jika ada
    $alamat = $this->request->getPost('alamat');

    // Validasi sederhana (opsional)
    if (empty($nama)) {
        return redirect()->back()->with('error', 'Nama tidak boleh kosong.');
    }

    // Update data user
    $userModel->update($userId, [
        'nama' => $nama,
        'nama_akhir' => $nama_akhir, // jika field ini ada di DB
        'alamat' => $alamat,
    ]);

    return redirect()->to('/user/profil')->with('success', 'Profil berhasil diperbarui.');
}

public function riwayat()
{
    // Ambil data riwayat transaksi dari database
    // Misalnya, menggunakan model untuk mengambil data
    $userModel = new UserModel();
    $userId = session()->get('id');
    
    // Ambil riwayat transaksi berdasarkan user ID

    
    return view('user/riwayat');
}
}