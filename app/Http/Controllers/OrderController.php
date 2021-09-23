<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store()
    {
        $this->authorize('store', Order::class);

        $order = Auth::user()->ordering();

        return response()->json([
            'data' => [
                'order_id' => $order->id,
                'message' => 'Order is processed',
            ]
        ])->setStatusCode(201);
    }

    public function index()
    {
       return OrderResource::collection(Auth::user()->orders);
    }
}
