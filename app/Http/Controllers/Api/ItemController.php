<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // GET /api/items
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $items
        ]);
    }

    // POST /api/items
    public function store(Request $request)
    {
        $request->validate([
            'kode_item' => 'required|unique:item,kode_item',
            'nama_item' => 'required'
        ]);

        $item = Item::create($request->only([
            'kode_item',
            'nama_item'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'item berhasil ditambahkan',
            'data' => $item
        ], 201);
    }

    // GET /api/items/{id}
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'item tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $item
        ]);
    }

    // PUT /api/items/{id}
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'item tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'kode_item' => 'required|unique:item,kode_item,' . $id . ',id_item',
            'nama_item' => 'required'
        ]);

        $item->update($request->only([
            'kode_item',
            'nama_item'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'item berhasil diperbarui',
            'data' => $item
        ]);
    }

    // DELETE /api/items/{id}
    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'item tidak ditemukan'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'item berhasil dihapus'
        ]);
    }
}
