<?php

namespace App;

use App\Models\Product;
use App\Models\ProductRepository;

class DatabaseProductRepository implements ProductRepository
{
    public function add(Product $product): Product
    {
        $product->save();

        return $product;
    }

    public function remove(int $productId)
    {
        Product::destroy($productId);
    }
}
