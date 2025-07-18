<?php

// app/Database/Migrations/2025-07-14-000002_CreateDonasiTable.php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDonasiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_donasi' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_donatur' => ['type' => 'INT', 'unsigned' => true],
            'tanggal_donasi' => ['type' => 'DATE'],
            'nominal' => ['type' => 'BIGINT'],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_donasi', true);
        $this->forge->addForeignKey('id_donatur', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('donasi');
    }

    public function down()
    {
        $this->forge->dropTable('donasi');
    }
}
