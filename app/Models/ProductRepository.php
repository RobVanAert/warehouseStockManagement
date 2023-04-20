<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ProductRepository
{
    public function add(Product $product): Product;

    public function remove(int $productId);

    /**
     * @throws ModelNotFoundException
     */
    public function ofId(int $productId): Product;

    public function update(Product $product);
}
