<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ObatModel;
use App\Models\TransaksiModel;
use App\Models\ChatModel;

class UserController extends BaseController
{

    protected $obatModel;
    protected $db;

    public function __construct()
    {
        $this->obatModel = new ObatModel();
        $this->db = \Config\Database::connect();
    }

    public function katalog()
    {
        $query = $this->request->getGet('q');

        $obatModel = new ObatModel();

        if ($query) {
            $obat = $obatModel->like('nama_obat', $query)->orLike('kemasan', $query)->findAll();
        } else {
            $obat = $obatModel->findAll();
        }

        $data = [
            'obat' => $obat
        ];

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

        $dataBaru = [
            'nama'   => $request->getPost('nama'),
            'email'  => $request->getPost('email'),
            'no_hp'  => $request->getPost('no_hp'),
            'alamat' => $request->getPost('alamat'),
        ];

        // Ambil data lama dari database
        $dataLama = $userModel->find($id);

        // Bandingkan data baru dan lama
        if ($dataBaru === array_intersect_key($dataLama, $dataBaru)) {
            return redirect()->back()->with('error', 'Tidak ada perubahan yang dilakukan.');
        }

        $userModel->update($id, $dataBaru);
        return redirect()->to('/user/profil')->with('success', 'Data berhasil diperbarui.');
    }

    public function riwayat()
    {
        $userId = session()->get('id');
        $transaksiModel = new TransaksiModel();

        // Ambil transaksi milik user ini
        $data['riwayat'] = $transaksiModel
            ->where('id_user', $userId)
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();

        return view('user/riwayat', $data);
    }

    public function printView($id)
    {
        // Ambil transaksi
        $transaksi = $this->db->table('transaksi')->where('id', $id)->get()->getRow();

        if (!$transaksi) {
            return "Transaksi tidak ditemukan.";
        }

        // Ambil user yang melakukan transaksi
        $user = $this->db->table('users')->where('id', $transaksi->id_user)->get()->getRow();

        $data = [
            'transaksi' => $transaksi,
            'user' => $user
        ];

        return view('user/print_transaksi', $data);
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
            return redirect()->back()->with('errorp', 'Password lama salah.');
        }

        // Validasi konfirmasi password
        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('errorp', 'Konfirmasi password tidak cocok.');
        }

        // Update password (hash dulu sebelum disimpan)
        $data = [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ];

        $userModel->update($id, $data);

        return redirect()->to('/user/profil')->with('successp', 'Password berhasil diubah.');
    }

    public function bantuan()
    {
        $chatModel = new ChatModel();
        $userId = session()->get('id');

        // Buat thread_id unik untuk user ini (user_[id])
        $threadId = 'user_' . $userId;

        // Ambil chat berdasarkan thread_id
        $data['chats'] = $chatModel
            ->where('thread_id', $threadId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $data['user_id'] = $userId;
        $data['thread_id'] = $threadId;

        return view('user/bantuan', $data);
    }

    public function sendMessage()
    {
        $chatModel = new ChatModel();
        $request = \Config\Services::request();

        $userId = session()->get('id');
        $message = $request->getPost('message');

        if (empty($message)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pesan tidak boleh kosong'
            ]);
        }

        $threadId = 'user_' . $userId;

        $data = [
            'thread_id' => $threadId,
            'sender_role' => 'user',
            'sender_id' => $userId,
            'recipient_id' => null, // Untuk apoteker (bisa diisi ID apoteker spesifik jika perlu)
            'message' => $message
        ];

        $result = $chatModel->insert($data);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pesan berhasil dikirim',
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengirim pesan'
            ]);
        }
    }

    public function getMessages()
    {
        $chatModel = new ChatModel();
        $userId = session()->get('id');
        $threadId = 'user_' . $userId;

        // Ambil chat berdasarkan thread_id saja
        $chats = $chatModel
            ->where('thread_id', $threadId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $chats
        ]);
    }
}
