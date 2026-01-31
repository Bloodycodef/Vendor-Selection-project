<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController3 extends Controller
{
    // =========================
    // REPORT 3
    // =========================
    public function vendorItemPriceRate()
    {
        $vendors = DB::table('vendor')->get();

        $data = [];

        foreach ($vendors as $vendor) {
            $items = DB::table('vendor_item')
                ->join('item', 'item.id_item', '=', 'vendor_item.id_item')
                ->where('vendor_item.id_vendor', $vendor->id_vendor)
                ->select(
                    'item.id_item',
                    'item.kode_item',
                    'item.nama_item',
                    'vendor_item.harga_sebelum',
                    'vendor_item.harga_sekarang'
                )
                ->get()
                ->map(function ($item) {
                    $selisih = $item->harga_sekarang - $item->harga_sebelum;

                    if ($selisih > 0) {
                        $status = 'up';
                    } elseif ($selisih < 0) {
                        $status = 'down';
                    } else {
                        $status = 'stable';
                    }

                    $rate = $item->harga_sebelum > 0
                        ? round(($selisih / $item->harga_sebelum) * 100, 2)
                        : 0;

                    return [
                        'id_item'        => $item->id_item,
                        'kode_item'      => $item->kode_item,
                        'nama_item'      => $item->nama_item,
                        'harga_sebelum'  => (float) $item->harga_sebelum,
                        'harga_sekarang' => (float) $item->harga_sekarang,
                        'selisih'        => abs($selisih),
                        'rate'           => $rate,
                        'status'         => $status
                    ];
                });

            if ($items->count() > 0) {
                $data[] = [
                    'id_vendor'   => $vendor->id_vendor,
                    'kode_vendor' => $vendor->kode_vendor,
                    'nama_vendor' => $vendor->nama_vendor,
                    'item'        => $items
                ];
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'data ditemukan',
            'data'    => $data
        ]);
    }
}
