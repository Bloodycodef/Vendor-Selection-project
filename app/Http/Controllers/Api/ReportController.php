<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // =========================
    // REPORT 1
    // =========================
    public function vendorItems()
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
                    'item.nama_item'
                )
                ->get();

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
