<?php

// app/Database/Migrations/2025-07-14-000003_CreatePenggunaanDanaTable.php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenggunaanDanaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penggunaan'  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'tanggal'        => ['type' => 'DATE'],
            'deskripsi'      => ['type' => 'TEXT'],
            'jumlah'         => ['type' => 'BIGINT'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_penggunaan', true);
        $this->forge->createTable('penggunaan_dana');
    }

    public function down()
    {
        $this->forge->dropTable('penggunaan_dana');
    }
}
