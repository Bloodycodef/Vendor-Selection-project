<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorItem extends Model
{
    use HasFactory;

    protected $table = 'vendor_item';
    protected $primaryKey = 'id_vendor_item';

    protected $fillable = [
        'id_vendor',
        'id_item',
        'harga_sebelum',
        'harga_sekarang'
    ];
}
