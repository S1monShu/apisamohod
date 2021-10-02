<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCartResource;
use App\Models\Product;
use App\Models\ProductCart;


class ProductCartController extends Controller
{
    public function addProduct(Product $product)
    {
        ProductCart::create([
            'user_id' => Auth()->id(),
            'product_id' => $product->id
        ]);
        return response()->json([
            'content' => [
                'message' => 'Товар в корзине',
            ]
        ])->setStatusCode(201);
    }

    public function show()
    {
        return ProductCartResource::collection(Auth()->user()->cart);
    }

    public function remove(ProductCart $productCart)
    {
        $this->authorize('remove', $productCart);

        $productCart->delete();
        return [
            'content' => [
                'message' => 'Позиция удалена из корзины',
            ]
        ];
    }
}
