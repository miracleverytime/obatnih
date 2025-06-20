<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password', 'reset_token', 'reset_token_expire', 'no_hp', 'alamat', 'tanggal_lahir', 'created_at'];
}
