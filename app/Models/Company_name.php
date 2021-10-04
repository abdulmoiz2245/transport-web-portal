<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_name extends Model
{
    use HasFactory;
    protected $table = 'company_names';

    protected $fillable = [
        'name'
    ];
}
