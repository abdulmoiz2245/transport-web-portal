<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civil_defense_documents extends Model
{
    use HasFactory;
    protected $table = 'civil_defense_files';

    protected $fillable = [
        'document',
        'type',
        'expiary_date'
    ];
}
