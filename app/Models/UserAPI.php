<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAPI extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'username', 'password', 'email', 'tglLahir', 'telepon', 'alamat'
    ];
}
