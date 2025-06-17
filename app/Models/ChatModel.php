<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table            = 'chat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sender_role', 'sender_id', 'message', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'sender_role' => 'required|in_list[user,apoteker]',
        'sender_id' => 'required|integer',
        'message' => 'required|max_length[1000]'
    ];
    
    protected $validationMessages = [
        'sender_role' => [
            'required' => 'Role pengirim harus diisi',
            'in_list' => 'Role pengirim harus user atau apoteker'
        ],
        'sender_id' => [
            'required' => 'ID pengirim harus diisi',
            'integer' => 'ID pengirim harus berupa angka'
        ],
        'message' => [
            'required' => 'Pesan tidak boleh kosong',
            'max_length' => 'Pesan terlalu panjang (maksimal 1000 karakter)'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get chat conversation involving a specific user
     */
    public function getConversationByUser($userId)
    {
        return $this->groupStart()
                    ->where('sender_role', 'user')
                    ->where('sender_id', $userId)
                ->groupEnd()
                ->orWhere('sender_role', 'apoteker')
                ->orderBy('created_at', 'ASC')
                ->findAll();
    }

    /**
     * Get users who have sent messages
     */
    public function getUsersWithChats()
    {
        return $this->select('chat.sender_id, users.nama, MAX(chat.created_at) as last_message')
               ->join('users', 'users.id = chat.sender_id')
               ->where('chat.sender_role', 'user')
               ->groupBy('chat.sender_id')
               ->orderBy('last_message', 'DESC')
               ->findAll();
    }

    /**
     * Count unread messages from users (for apoteker dashboard)
     */
    public function getUnreadUserMessagesCount()
    {
        return $this->where('sender_role', 'user')
               ->where('created_at >', date('Y-m-d H:i:s', strtotime('-24 hours')))
               ->countAllResults();
    }

    /**
     * Get latest message from each user
     */
    public function getLatestMessagesByUsers()
    {
        return $this->select('chat.*, users.nama as user_name')
               ->join('users', 'users.id = chat.sender_id')
               ->where('chat.sender_role', 'user')
               ->orderBy('chat.created_at', 'DESC')
               ->findAll();
    }

    /**
     * Check if user has active conversation
     */
    public function hasActiveConversation($userId)
    {
        $lastMessage = $this->where('sender_id', $userId)
                           ->orderBy('created_at', 'DESC')
                           ->first();
        
        if ($lastMessage) {
            $timeDiff = time() - strtotime($lastMessage['created_at']);
            return $timeDiff < 3600; // Active if last message within 1 hour
        }
        
        return false;
    }
}