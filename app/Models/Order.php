<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'tanggal_order',
        'no_order',
        'id_vendor',
        'id_item'
    ];
}
