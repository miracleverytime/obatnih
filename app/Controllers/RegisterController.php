<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
public function submit()
{
    $data = $this->request->getPost();
    $validation = \Config\Services::validation();
    $userModel = new \App\Models\UserModel();

    // Cek apakah email sudah terdaftar
    if ($userModel->where('email', $data['email'])->first()) {
        return redirect()->back()->withInput()->with('error', 'Email sudah terdaftar, gunakan email lain.');
    }

    // Aturan validasi
    $rules = [
        'nama'           => 'required|min_length[3]',
        'email'          => 'required|valid_email',
        'password'       => 'required|min_length[8]',
        'no_hp'          => 'required',
        'tanggal_lahir'  => 'required|valid_date',
    ];

    // Jalankan validasi
    if (!$validation->setRules($rules)->run($data)) {
        return redirect()->back()->withInput()->with('error', $validation->listErrors());
    }

    // Simpan data
    try {
        $userModel->save([
            'nama'           => $data['nama'],
            'email'          => $data['email'],
            'password'       => password_hash($data['password'], PASSWORD_DEFAULT),
            'no_hp'          => $data['no_hp'],
            'tanggal_lahir'  => $data['tanggal_lahir'],
        ]);

        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}


}
