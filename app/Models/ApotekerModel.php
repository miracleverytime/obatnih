<?php

namespace App\Models;

use CodeIgniter\Model;

class ApotekerModel extends Model
{
    protected $table = 'apoteker';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password', 'created_at'];
}
