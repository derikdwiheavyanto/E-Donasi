<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaanDanaModel extends Model
{
    protected $table            = 'penggunaan_dana';
    protected $primaryKey       = 'id_penggunaan';


    public function getSumPengeluaran()
    {
        return $this->selectSum('jumlah')->get()->getRow()->jumlah;
    }
}
