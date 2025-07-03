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

        // Validasi input kosong
        if (empty($email) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Email dan password wajib diisi.');
        }

        $models = [
            'user'     => new \App\Models\UserModel(),
            'admin'    => new \App\Models\AdminModel(),
            'apoteker' => new \App\Models\ApotekerModel(),
        ];

        foreach ($models as $role => $model) {
            $user = $model->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Siapkan data sesi dasar
                $sessionData = [
                    'id'       => $user['id'],
                    'email'    => $user['email'],
                    'nama'     => $user['nama'] ?? '',
                    'role'     => $role,
                    'isLogin'  => true,
                ];

                // Tambahkan info tambahan khusus user
                if ($role === 'user') {
                    $sessionData['alamat'] = $user['alamat'] ?? '';
                    $sessionData['no_hp']  = $user['no_hp'] ?? '';
                }

                session()->set($sessionData);

                // Redirect berdasarkan peran
                if ($role === 'user') {
                    return redirect()->to('/user/katalog');
                } elseif ($role === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($role === 'apoteker') {
                    return redirect()->to('/apoteker/validasi');
                }
            } elseif ($user) {
                // Jika user ditemukan tapi password salah
                return redirect()->back()->withInput()->with('error', 'Password salah');
            }
        }

        // Jika email tidak ditemukan di semua model
        return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan');
    }
}
