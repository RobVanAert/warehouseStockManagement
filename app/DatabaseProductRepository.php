<?php

namespace App;

use App\Models\Product;
use App\Models\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * @throws ModelNotFoundException
     */
    public function ofId(int $productId): Product
    {
        return Product::findOrFail($productId);
    }

    public function update(Product $product)
    {
        $product->save();
    }

    public function getPaginated(): LengthAwarePaginator
    {
        return Product::paginate(10);
    }
}
