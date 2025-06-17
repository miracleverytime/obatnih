<?php

namespace App\Controllers;

class ApotekerController extends BaseController
{
    public function dashboard(): string
    {
        return view('apoteker/dashboard');
    }

    public function bantuan(): string
    {
        return view('apoteker/bantuan');
    }

    public function logout(): string
    {
        return view('login');
    }
}