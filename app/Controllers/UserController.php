<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ObatModel;


class UserController extends BaseController
{    

    protected $obatModel;
    
    public function __construct()
    {
        $this->obatModel = new ObatModel();
    }

    public function katalog(): string
    {
        $data['obat'] = $this->obatModel->findAll();
        
        return view('user/katalog', $data);
    }


    public function detailp($id)
    {
        // Ambil data obat berdasarkan ID
        $obat = $this->obatModel->getObat($id);
        
        // Cek apakah data obat ditemukan
        if (!$obat) {
            // Jika tidak ditemukan, redirect atau tampilkan error
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Obat dengan ID ' . $id . ' tidak ditemukan');
        }
        
        $data = [
            'obat' => $obat
        ];
        
        return view('user/detail_produk', $data); // sesuaikan path view Anda
    }



}