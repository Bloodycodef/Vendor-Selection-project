<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    // GET /api/vendors
    public function getVendor()
    {
        $vendors = Vendor::all();

        if ($vendors->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Data vendor tidak ditemukan',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data vendor ditemukan',
            'data' => $vendors
        ]);
    }

    // POST /api/vendors
    public function addVendor(Request $request)
    {
        $request->validate([
            'kode_vendor' => 'required|unique:vendor,kode_vendor',
            'nama_vendor' => 'required'
        ]);

        $vendor = Vendor::create($request->only([
            'kode_vendor',
            'nama_vendor'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'vendor berhasil ditambahkan',
            'data' => $vendor
        ], 201);
    }

    // GET /api/vendors/{id}
    public function showVendorById($id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json([
                'status' => false,
                'message' => 'vendor tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $vendor
        ]);
    }

    // PUT /api/vendors/{id}
    public function updateVendor(Request $request, $id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json([
                'status' => false,
                'message' => 'vendor tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama_vendor' => 'required|string|max:255'
        ]);

        $vendor->update([
            'nama_vendor' => $request->nama_vendor
        ]);

        return response()->json([
            'status' => true,
            'message' => 'nama vendor berhasil diperbarui',
            'data' => $vendor
        ]);
    }

    // DELETE /api/vendors/{id}
    public function deleteVendor($id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json([
                'status' => false,
                'message' => 'vendor tidak ditemukan'
            ], 404);
        }

        $vendor->delete();

        return response()->json([
            'status' => true,
            'message' => 'vendor berhasil dihapus'
        ]);
    }
}
