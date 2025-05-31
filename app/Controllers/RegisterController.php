<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function submit()
    {
        $validation = \Config\Services::validation();

        $data = $this->request->getPost();

        // Validasi input
        $validation->setRules([
            'nama'           => 'required|min_length[3]',
            'email'          => 'required|valid_email|is_unique[users.email]',
            'password'       => 'required|min_length[8]',
            'no_hp'          => 'required',
            'alamat'         => 'required',
            'tanggal_lahir'  => 'required|valid_date',
        ]);

        if (!$validation->run($data)) {
            echo('error');
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama'           => $data['nama'],
            'email'          => $data['email'],
            'password'       => password_hash($data['password'], PASSWORD_DEFAULT),
            'no_hp'          => $data['no_hp'],
            'tanggal_lahir'  => $data['tanggal_lahir'],
        ]);

        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil, silakan login!');
    }
}
