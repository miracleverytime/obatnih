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
    
    // UPDATE: Tambah thread_id dan recipient_id ke allowedFields
    protected $allowedFields    = [
        'sender_role', 
        'sender_id', 
        'message', 
        'thread_id', 
        'recipient_id', 
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];

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

    // UPDATE: Validation dengan thread_id
    protected $validationRules = [
        'sender_role' => 'required|in_list[user,apoteker]',
        'sender_id' => 'required|integer',
        'message' => 'required|max_length[1000]',
        'thread_id' => 'required|max_length[50]'
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
        ],
        'thread_id' => [
            'required' => 'Thread ID harus diisi',
            'max_length' => 'Thread ID terlalu panjang'
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
     * NEW: Get chat by thread ID
     */
    public function getChatByThread($threadId)
    {
        return $this->where('thread_id', $threadId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    /**
     * NEW: Get active threads with last message info
     */
    public function getActiveThreads()
    {
        return $this->select('thread_id, MAX(created_at) as last_message, COUNT(*) as message_count')
               ->groupBy('thread_id')
               ->orderBy('last_message', 'DESC')
               ->findAll();
    }

    /**
     * NEW: Get thread participants info
     */
    public function getThreadWithUserInfo($threadId)
    {
        return $this->select('chat.*, users.nama as user_name')
               ->join('users', 'users.id = chat.sender_id', 'left')
               ->where('chat.thread_id', $threadId)
               ->orderBy('chat.created_at', 'ASC')
               ->findAll();
    }

    /**
     * UPDATE: Get conversation by user dengan thread support
     */
    public function getConversationByUser($userId)
    {
        $threadId = 'user_' . $userId;
        return $this->getChatByThread($threadId);
    }

    /**
     * UPDATE: Get users who have active threads
     */
    public function getUsersWithChats()
    {
        return $this->select('SUBSTRING(chat.thread_id, 6) as user_id, users.nama, MAX(chat.created_at) as last_message')
               ->join('users', 'users.id = SUBSTRING(chat.thread_id, 6)', 'inner')
               ->where('chat.thread_id LIKE', 'user_%')
               ->groupBy('chat.thread_id')
               ->orderBy('last_message', 'DESC')
               ->findAll();
    }

    /**
     * NEW: Get unread messages count for specific thread
     */
    public function getUnreadMessagesCount($threadId, $lastReadTime = null)
    {
        $builder = $this->where('thread_id', $threadId);
        
        if ($lastReadTime) {
            $builder->where('created_at >', $lastReadTime);
        } else {
            $builder->where('created_at >', date('Y-m-d H:i:s', strtotime('-24 hours')));
        }
        
        return $builder->countAllResults();
    }

    /**
     * UPDATE: Count unread messages from users (for apoteker dashboard)
     */
    public function getUnreadUserMessagesCount()
    {
        return $this->where('sender_role', 'user')
               ->where('created_at >', date('Y-m-d H:i:s', strtotime('-24 hours')))
               ->countAllResults();
    }

    /**
     * NEW: Get latest message for each active thread
     */
    public function getLatestMessagesByThreads()
    {
        $subQuery = $this->select('thread_id, MAX(created_at) as max_created_at')
                        ->groupBy('thread_id')
                        ->getCompiledSelect();

        return $this->select('chat.*, users.nama as user_name')
               ->join("($subQuery) as latest", 'latest.thread_id = chat.thread_id AND latest.max_created_at = chat.created_at')
               ->join('users', 'users.id = SUBSTRING(chat.thread_id, 6)', 'left')
               ->where('chat.thread_id LIKE', 'user_%')
               ->orderBy('chat.created_at', 'DESC')
               ->findAll();
    }

    /**
     * UPDATE: Check if user has active conversation
     */
    public function hasActiveConversation($userId)
    {
        $threadId = 'user_' . $userId;
        $lastMessage = $this->where('thread_id', $threadId)
                           ->orderBy('created_at', 'DESC')
                           ->first();
        
        if ($lastMessage) {
            $timeDiff = time() - strtotime($lastMessage['created_at']);
            return $timeDiff < 3600; // Active if last message within 1 hour
        }
        
        return false;
    }

    /**
     * NEW: Create thread ID for user
     */
    public function createUserThreadId($userId)
    {
        return 'user_' . $userId;
    }

    /**
     * NEW: Extract user ID from thread ID
     */
    public function extractUserIdFromThread($threadId)
    {
        if (preg_match('/^user_(\d+)$/', $threadId, $matches)) {
            return (int)$matches[1];
        }
        return null;
    }

    /**
     * NEW: Get thread statistics
     */
    public function getThreadStats($threadId)
    {
        $stats = $this->select('
                COUNT(*) as total_messages,
                COUNT(CASE WHEN sender_role = "user" THEN 1 END) as user_messages,
                COUNT(CASE WHEN sender_role = "apoteker" THEN 1 END) as apoteker_messages,
                MIN(created_at) as first_message,
                MAX(created_at) as last_message
            ')
            ->where('thread_id', $threadId)
            ->first();

        return $stats;
    }

    /**
     * NEW: Search messages in thread
     */
    public function searchInThread($threadId, $keyword)
    {
        return $this->where('thread_id', $threadId)
                    ->like('message', $keyword)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}