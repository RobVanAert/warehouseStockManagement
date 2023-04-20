<?php

namespace App\Models;

interface ProductRepository
{
    public function add(Product $product): Product;

    public function remove(int $productId);
}
