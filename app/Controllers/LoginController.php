<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\ApotekerModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function loginForm()
    {
        // Jika sudah login dan akses ulang halaman login, reset session
        if (session()->get('isLogin')) {
            session()->destroy();
        }

        return view('login');
    }

    // Memproses login
public function login()
{
    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Cek input kosong
    if (empty($email) || empty($password)) {
        return redirect()->back()->withInput()->with('error', 'Email dan password wajib diisi.');
    }

    $models = [
        'user'     => new UserModel(),
        'admin'    => new AdminModel(),
        'apoteker' => new ApotekerModel(),
    ];

    foreach ($models as $role => $model) {
        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'id'      => $user['id'],
                    'email'   => $user['email'],
                    'alamat'   => $user['alamat'],
                    'no_hp'   => $user['no_hp'],
                    'nama'    => $user['nama'] ?? '',
                    'role'    => $role,
                    'isLogin' => true,
                ]);

                // Redirect sesuai role
                if ($role === 'user') {
                    return redirect()->to('/user/katalog');
                } elseif ($role === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($role === 'apoteker') {
                    return redirect()->to('/apoteker/validasi');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah');
            }
        }
    }

    return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan');
}



}
