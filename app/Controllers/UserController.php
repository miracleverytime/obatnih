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


    public function updateProfil()
{
        $userModel = new UserModel();

        $request = \Config\Services::request();
        $id = session()->get('id'); 

        $data = [
            'nama'   => $request->getPost('nama'),
            'email'    => $request->getPost('email'),
            'password'    => $request->getPost('password'),
            'no_hp'    => $request->getPost('no_hp'),
            'alamat' => $request->getPost('alamat'),
        ];


        if (!empty(array_filter($data))) {
            $userModel->update($id, $data);
            return redirect()->to('/user/profil')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang dikirim.');
        }
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

    public function gantiPassword()
    {
        // Tampilkan halaman ganti password
        return view('user/ganti_password');
    }

    public function updatePassword()
{
    $userModel = new UserModel();
    $request = \Config\Services::request();
    $session = session();
    $id = $session->get('id');

    $oldPassword = $request->getPost('old_password');
    $newPassword = $request->getPost('new_password');
    $confirmPassword = $request->getPost('confirm_password');

    // Ambil data user berdasarkan ID
    $user = $userModel->find($id);

    // Validasi password lama
    if (!password_verify($oldPassword, $user['password'])) {
        return redirect()->back()->with('error', 'Password lama salah.');
    }

    // Validasi konfirmasi password
    if ($newPassword !== $confirmPassword) {
        return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
    }

    // Update password (hash dulu sebelum disimpan)
    $data = [
        'password' => password_hash($newPassword, PASSWORD_DEFAULT)
    ];

    $userModel->update($id, $data);

    return redirect()->to('/user/profil')->with('success', 'Password berhasil diubah.');
}

public function bantuan()
{
    return view('user/bantuan');
}

}