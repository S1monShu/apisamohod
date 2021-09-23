<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        $product = Product::factory()->create($request->all());

        return response()->json([
            'data' => [
                'id' => $product->id,
                'message' => 'Product added',
            ]
        ])->setStatusCode(201);
    }
}
