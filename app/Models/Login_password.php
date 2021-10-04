<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login_password extends Model
{
    use HasFactory;
    protected $table = 'login_passwords';

    protected $fillable = [
        'body'
    ];
    
    // protected $primaryKey = 'id';
}
