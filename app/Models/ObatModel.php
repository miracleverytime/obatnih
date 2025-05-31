<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table = 'obat'; // Nama tabel di database
    protected $primaryKey = 'id_obat'; // Primary key tabel
    protected $allowedFields = ['nama_obat', 'dosis', 'kemasan', 'komposisi', 'golongan_obat', 'kontra_indikasi', 'harga_satuan', 'stok', 'cara_pakai', 'efek_samping', 'deskripsi', 'gambar_obat'];

    public function getObat($id)
    {
        return $this->where('id_obat', $id)->first();
    }
}