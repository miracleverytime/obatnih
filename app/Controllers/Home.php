<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function login(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('signup');
    }

    public function lupapassword(): string
    {
        return view('lupa_pass');
    }
}
