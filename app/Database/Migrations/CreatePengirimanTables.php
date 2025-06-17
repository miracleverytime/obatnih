<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengirimanTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal_transaksi' => ['type' => 'DATETIME'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
