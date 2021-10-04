<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade_license extends Model
{
    use HasFactory;

    protected $table = 'trade_licenses';

    protected $fillable = [
        'company_id',
        'id_card',
        'visa',
        'member_ship_certificate',
        'passport',
        'sponsor_page',
        'trade_name',
        'license_number',
        'expiary_date',
        'trade_license_copy',
    ];
}
