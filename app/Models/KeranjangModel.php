<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{

    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_obat', 'jumlah'];

    public function getKeranjang()
    {
        return $this->select('keranjang.id, obat.nama_obat, keranjang.jumlah')
                    ->join('obat', 'obat.id_obat = keranjang.id_obat')
                    ->findAll();
    }
}


