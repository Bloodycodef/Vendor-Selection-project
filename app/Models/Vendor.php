<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendor';

    protected $primaryKey = 'id_vendor';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_vendor',
        'nama_vendor'
    ];
}
