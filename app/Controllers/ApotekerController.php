<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\UserModel;

class ApotekerController extends BaseController
{
    protected $transaksiModel;
    protected $userModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->userModel = new UserModel();
    }

    public function dashboard()
    {
        // Ambil data transaksi beserta nama pengguna
        $transaksi = $this->transaksiModel
            ->select('transaksi.*, users.nama')
            ->join('users', 'users.id = transaksi.id_user')
            ->findAll();

        return view('apoteker/dashboard', ['transaksi' => $transaksi]);
    }

    public function bantuan()
        {
            return view('apoteker/bantuan');
        }

        public function logout()
        {
            return view('login');
        }

    public function validasi_transaksi($id)
    {
        $this->transaksiModel->update($id, ['status' => 'selesai']);
        session()->setFlashdata('success', 'Transaksi berhasil divalidasi.');
        return redirect()->to('/apoteker/dashboard');
    }

    public function batalkan_transaksi($id)
    {
        $this->transaksiModel->update($id, ['status' => 'dibatalkan']);
        session()->setFlashdata('success', 'Transaksi berhasil dibatalkan.');
        return redirect()->to('/apoteker/dashboard');
    }

}
