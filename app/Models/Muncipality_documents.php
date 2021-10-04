<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muncipality_documents extends Model
{
    use HasFactory;
    protected $table = 'muncipality_documents';

    protected $fillable = [
        'document',
        'type',
        'expiary_date'
    ];
}
