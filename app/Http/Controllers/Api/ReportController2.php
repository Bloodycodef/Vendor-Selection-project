<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController2 extends Controller
{
    public function vendorRanking()
    {
        $data = DB::table('order')
            ->join('vendor', 'vendor.id_vendor', '=', 'order.id_vendor')
            ->select(
                'vendor.id_vendor',
                'vendor.kode_vendor',
                'vendor.nama_vendor',
                DB::raw('COUNT(order.id_order) as jumlah_transaksi')
            )
            ->groupBy(
                'vendor.id_vendor',
                'vendor.kode_vendor',
                'vendor.nama_vendor'
            )
            ->orderByDesc('jumlah_transaksi')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'data ditemukan',
            'data'    => $data
        ]);
    }
}
