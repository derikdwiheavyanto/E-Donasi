<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnBuktiTablePenggunaanDana extends Migration
{
    public function up()
    {
         $this->forge->addColumn('penggunaan_dana', [
            'bukti_foto' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
        ]);

    }

    public function down()
    {
        //
    }
}
