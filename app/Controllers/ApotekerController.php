<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\ChatModel;

class ApotekerController extends BaseController
{
    protected $transaksiModel;
    protected $userModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        // Ambil data transaksi beserta nama pengguna
        $transaksi = $this->transaksiModel
            ->select('transaksi.*, users.nama')
            ->join('users', 'users.id = transaksi.id_user')
            ->findAll();

        return view('apoteker/dashboard', ['transaksi' => $transaksi]);
    }

    public function logout()
    {
        return view('login');
    }

    public function validasi_transaksi($id)
    {
        $this->transaksiModel->update($id, ['status' => 'selesai']);
        session()->setFlashdata('success', 'Transaksi berhasil divalidasi.');
        return redirect()->to('/apoteker/dashboard');
    }

    public function batalkan_transaksi($id)
    {
        $this->transaksiModel->update($id, ['status' => 'dibatalkan']);
        session()->setFlashdata('success', 'Transaksi berhasil dibatalkan.');
        return redirect()->to('/apoteker/dashboard');
    }

    public function bantuan()
    {
        $chatModel = new ChatModel();
        $userModel = new UserModel();

        // Ambil daftar thread chat yang aktif (group by thread_id)
        $activeThreads = $chatModel
            ->select('thread_id, MAX(created_at) as last_message')
            ->groupBy('thread_id')
            ->orderBy('last_message', 'DESC')
            ->findAll();

        // Ambil informasi user untuk setiap thread
        $users = [];
        foreach ($activeThreads as $thread) {
            // Extract user_id from thread_id (format: user_123)
            if (preg_match('/user_(\d+)/', $thread['thread_id'], $matches)) {
                $userId = $matches[1];
                $user = $userModel->find($userId);
                if ($user) {
                    $users[] = [
                        'id' => $userId,
                        'nama' => $user['nama'],
                        'thread_id' => $thread['thread_id'],
                        'last_message' => $thread['last_message']
                    ];
                }
            }
        }

        $data = [
            'users' => $users
        ];

        return view('apoteker/bantuan', $data);
    }

    public function sendReply()
    {
        $chatModel = new ChatModel();
        $request = \Config\Services::request();

        $userId = $request->getPost('user_id');
        $message = $request->getPost('message');

        if (empty($message) || empty($userId)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak lengkap'
            ]);
        }

        $threadId = 'user_' . $userId;

        $data = [
            'thread_id' => $threadId,
            'sender_role' => 'apoteker',
            'sender_id' => session()->get('id'),
            'recipient_id' => $userId,
            'message' => $message
        ];

        $result = $chatModel->insert($data);

        if ($result) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Balasan berhasil dikirim',
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengirim balasan'
            ]);
        }
    }

    public function getChatByUser($userId)
    {
        $chatModel = new ChatModel();
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
