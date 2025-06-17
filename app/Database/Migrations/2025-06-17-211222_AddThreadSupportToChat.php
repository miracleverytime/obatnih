<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddThreadSupportToChat extends Migration
{
    public function up()
    {
        // Tambah kolom thread_id dan recipient_id
        $this->forge->addColumn('chat', [
            'thread_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'sender_id'
            ],
            'recipient_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'thread_id'
            ]
        ]);

        // Tambah index untuk performa
        $this->forge->addKey('thread_id', false, false, 'idx_thread_id');
        $this->forge->addKey(['sender_id', 'sender_role'], false, false, 'idx_sender');
        $this->forge->processIndexes('chat');

        // Update data yang sudah ada untuk menambah thread_id
        $this->updateExistingData();
    }

    public function down()
    {
        // Hapus index
        $this->forge->dropKey('chat', 'idx_thread_id');
        $this->forge->dropKey('chat', 'idx_sender');

        // Hapus kolom
        $this->forge->dropColumn('chat', ['thread_id', 'recipient_id']);
    }

    private function updateExistingData()
    {
        $db = \Config\Database::connect();
        
        // Update thread_id untuk pesan user yang sudah ada
        $db->query("
            UPDATE chat 
            SET thread_id = CONCAT('user_', sender_id) 
            WHERE sender_role = 'user' AND thread_id IS NULL
        ");

        // Update thread_id untuk pesan apoteker
        // Logika sederhana: ambil thread_id dari pesan user terakhir sebelum pesan apoteker
        $apotek_messages = $db->query("
            SELECT id, created_at 
            FROM chat 
            WHERE sender_role = 'apoteker' AND thread_id IS NULL 
            ORDER BY created_at ASC
        ")->getResultArray();

        foreach ($apotek_messages as $apoteker_msg) {
            // Cari pesan user terakhir sebelum pesan apoteker ini
            $last_user_msg = $db->query("
                SELECT sender_id 
                FROM chat 
                WHERE sender_role = 'user' 
                AND created_at < ? 
                ORDER BY created_at DESC 
                LIMIT 1
            ", [$apoteker_msg['created_at']])->getRowArray();

            if ($last_user_msg) {
                $thread_id = 'user_' . $last_user_msg['sender_id'];
                $db->query("
                    UPDATE chat 
                    SET thread_id = ? 
                    WHERE id = ?
                ", [$thread_id, $apoteker_msg['id']]);
            }
        }
    }
}
