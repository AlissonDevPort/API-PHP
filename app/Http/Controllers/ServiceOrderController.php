<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'vehiclePlate' => 'required|string|size:7',
                'entryDateTime' => 'required|date',
                'exitDateTime' => 'nullable|date',
                'priceType' => 'nullable|string|max:55',
                'price' => 'required|numeric|min:0',
                'userId' => 'required|exists:users,id',
            ]);
    
            $serviceOrder = ServiceOrder::create($validated);
    
            return response()->json([
                'message' => 'Service order created successfully.',
                'data' => $serviceOrder,
            ], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function list()
    {
        $serviceOrders = ServiceOrder::with('user')->get();

        return response()->json([
            'data' => $serviceOrders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'vehiclePlate' => $order->vehiclePlate,
                    'entryDateTime' => $order->entryDateTime,
                    'exitDateTime' => $order->exitDateTime,
                    'priceType' => $order->priceType,
                    'price' => $order->price,
                    'user' => $order->user->name,  
                ];
            }),
        ], 200);  
    }
}