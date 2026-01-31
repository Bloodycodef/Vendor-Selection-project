<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /api/orders
    public function index()
    {
        $orders = Order::all();

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $orders
        ]);
    }

    // POST /api/orders
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_order' => 'required|date',
            'no_order' => 'required|unique:order,no_order',
            'id_vendor' => 'required|exists:vendor,id_vendor',
            'id_item' => 'required|exists:item,id_item'
        ]);

        $order = Order::create([
            'tanggal_order' => $request->tanggal_order,
            'no_order' => $request->no_order,
            'id_vendor' => $request->id_vendor,
            'id_item' => $request->id_item
        ]);

        return response()->json([
            'status' => true,
            'message' => 'order berhasil ditambahkan',
            'data' => $order
        ], 201);
    }

    // GET /api/orders/{id}
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'order tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $order
        ]);
    }

    // PUT /api/orders/{id}
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'order tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'tanggal_order' => 'required|date',
            'id_vendor' => 'required|exists:vendors,id',
            'id_item' => 'required|exists:items,id_item'
        ]);

        $order->update($request->only([
            'tanggal_order',
            'id_vendor',
            'id_item'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'order berhasil diperbarui',
            'data' => $order
        ]);
    }

    // DELETE /api/orders/{id}
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'order tidak ditemukan'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'status' => true,
            'message' => 'order berhasil dihapus'
        ]);
    }
}
