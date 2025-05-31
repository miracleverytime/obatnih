<?php

namespace App\Controllers;

class ApotekerController extends BaseController
{
    public function dashboard(): string
    {
        return view('apoteker/dashboard');
    }
}