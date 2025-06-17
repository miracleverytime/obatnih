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

    // Ambil semua chat dengan informasi user
    $chats = $chatModel
        ->select('chat.*, users.nama as nama_user')
        ->join('users', 'users.id = chat.sender_id AND chat.sender_role = "user"', 'LEFT')
        ->orderBy('chat.created_at', 'ASC')
        ->findAll();

    // Group chat berdasarkan user
    $groupedChats = [];
    foreach ($chats as $chat) {
        if ($chat['sender_role'] == 'user') {
            $groupedChats[$chat['sender_id']][] = $chat;
        } else {
            // Untuk pesan dari apoteker, kita perlu tahu ke user mana
            // Karena struktur tabel tidak menyimpan recipient, kita ambil chat terakhir dari user
            $lastUserMessage = $chatModel
                ->where('sender_role', 'user')
                ->where('created_at <', $chat['created_at'])
                ->orderBy('created_at', 'DESC')
                ->first();
            
            if ($lastUserMessage) {
                $groupedChats[$lastUserMessage['sender_id']][] = $chat;
            }
        }
    }

    // Ambil daftar user yang pernah chat
    $users = $chatModel
        ->select('chat.sender_id, users.nama, MAX(chat.created_at) as last_message')
        ->join('users', 'users.id = chat.sender_id')
        ->where('chat.sender_role', 'user')
        ->groupBy('chat.sender_id')
        ->orderBy('last_message', 'DESC')
        ->findAll();

    $data = [
        'chats' => $chats,
        'groupedChats' => $groupedChats,
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
    
    $data = [
        'sender_role' => 'apoteker',
        'sender_id' => session()->get('id'), // ID apoteker yang sedang login
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
    
    // Ambil semua chat yang melibatkan user ini
    $chats = $chatModel
        ->groupStart()
            ->where('sender_role', 'user')
            ->where('sender_id', $userId)
        ->groupEnd()
        ->orWhere('sender_role', 'apoteker')
        ->orderBy('created_at', 'ASC')
        ->findAll();
    
    return $this->response->setJSON([
        'status' => 'success',
        'data' => $chats
    ]);
}

}
