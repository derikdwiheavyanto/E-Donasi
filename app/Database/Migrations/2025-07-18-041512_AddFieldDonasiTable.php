<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldDonasiTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('donasi', [
            'order_id' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'id_donasi'],
            'pembayaran' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

        $this->db->query('ALTER TABLE donasi ADD UNIQUE KEY order_id (order_id)');

    }


    public function down()
    {
        //
    }
}
