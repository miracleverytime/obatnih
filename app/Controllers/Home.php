<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index(): string
    {
        return view('index');
    }

    public function login(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('signup');
    }

    public function lupapassword(): string
    {
        return view('lupa_pass');
    }

    public function prosesLupaPassword()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Email tidak valid');
        }

        $email = $this->request->getPost('email');
        
        // Cek apakah email ada di database
        $user = $this->userModel->where('email', $email)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan dalam sistem');
        }

        // Generate token reset password (64 karakter random)
        $token = bin2hex(random_bytes(32));
        $expire = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token berlaku 1 jam

        // Simpan token ke database
        $this->userModel->update($user['id'], [
            'reset_token' => $token,
            'reset_token_expire' => $expire
        ]);

        // Kirim email reset password
        if ($this->kirimEmailReset($email, $token, $user['nama'])) {
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda. Cek inbox atau spam folder.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    // Method untuk menampilkan halaman reset password
    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to('login')->with('error', 'Token tidak valid');
        }

        // Cek token di database
        $user = $this->userModel->where('reset_token', $token)
                                ->where('reset_token_expire >', date('Y-m-d H:i:s'))
                                ->first();

        if (!$user) {
            return redirect()->to('login')->with('error', 'Token tidak valid atau sudah kadaluarsa. Silakan request ulang.');
        }

        return view('/reset', ['token' => $token]);
    }

    // Method untuk memproses reset password
    public function prosesResetPassword()
    {
        $rules = [
            'token' => 'required',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errorMessage = implode(', ', $errors);
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // Cek token masih valid
        $user = $this->userModel->where('reset_token', $token)
                                ->where('reset_token_expire >', date('Y-m-d H:i:s'))
                                ->first();

        if (!$user) {
            return redirect()->to('login')->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }

        // Update password dan hapus token
        $this->userModel->update($user['id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expire' => null
        ]);

        return redirect()->to('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
    }

    // Method untuk mengirim email reset password
    private function kirimEmailReset($email, $token, $nama)
    {
        $emailService = \Config\Services::email();
        
        $emailService->setFrom('noreply@obatnih.com', 'ObatNih Admin');
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password - ObatNih');
        
        $resetLink = base_url("reset-password/{$token}");
        
        $message = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <h2 style='color: #333;'>Reset Password ObatNih</h2>
            <p>Halo <strong>{$nama}</strong>,</p>
            <p>Anda telah meminta reset password untuk akun ObatNih Anda.</p>
            <p>Klik tombol berikut untuk reset password:</p>
            <div style='text-align: center; margin: 30px 0;'>
                <a href='{$resetLink}' 
                style='background-color: #007bff; color: white; padding: 12px 30px; 
                        text-decoration: none; border-radius: 5px; display: inline-block;'>
                    Reset Password
                </a>
            </div>
            <p>Atau copy dan paste link berikut ke browser Anda:</p>
            <p style='word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 4px;'>
                {$resetLink}
            </p>
            <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666; font-size: 14px;'>
                <p><strong>Penting:</strong></p>
                <ul>
                    <li>Link ini akan kadaluarsa dalam <strong>1 jam</strong></li>
                    <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
                    <li>Untuk keamanan, jangan share link ini dengan orang lain</li>
                </ul>
            </div>
            <hr style='margin: 30px 0; border: none; border-top: 1px solid #eee;'>
            <p>Terima kasih,<br><strong>Tim ObatNih</strong></p>
        </div>
        ";
        
        $emailService->setMessage($message);
        $emailService->setMailType('html');
        
        if ($emailService->send()) {
            log_message('info', 'Email reset password berhasil dikirim ke: ' . $email);
            return true;
        } else {
            log_message('error', 'Email reset password gagal dikirim: ' . $emailService->printDebugger());
            return false;
        }
    }

}
