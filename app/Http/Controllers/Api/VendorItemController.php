<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VendorItem;
use Illuminate\Http\Request;

class VendorItemController extends Controller
{
    // GET /api/vendor-items
    public function index()
    {
        $data = VendorItem::all();

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data
        ]);
    }

    // POST /api/vendor-items
    public function store(Request $request)
    {
        $request->validate([
            'id_vendor' => 'required|exists:vendors,id',
            'id_item' => 'required|exists:items,id_item',
            'harga_sebelum' => 'required|numeric',
            'harga_sekarang' => 'required|numeric'
        ]);

        $vendorItem = VendorItem::create($request->only([
            'id_vendor',
            'id_item',
            'harga_sebelum',
            'harga_sekarang'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'vendor item berhasil ditambahkan',
            'data' => $vendorItem
        ], 201);
    }

    // GET /api/vendor-items/{id}
    public function show($id)
    {
        $vendorItem = VendorItem::find($id);

        if (!$vendorItem) {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $vendorItem
        ]);
    }

    // PUT /api/vendor-items/{id}
    public function update(Request $request, $id)
    {
        $vendorItem = VendorItem::find($id);

        if (!$vendorItem) {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'harga_sebelum' => 'required|numeric',
            'harga_sekarang' => 'required|numeric'
        ]);

        $vendorItem->update($request->only([
            'harga_sebelum',
            'harga_sekarang'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'vendor item berhasil diperbarui',
            'data' => $vendorItem
        ]);
    }

    // DELETE /api/vendor-items/{id}
    public function destroy($id)
    {
        $vendorItem = VendorItem::find($id);

        if (!$vendorItem) {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        $vendorItem->delete();

        return response()->json([
            'status' => true,
            'message' => 'vendor item berhasil dihapus'
        ]);
    }
}
