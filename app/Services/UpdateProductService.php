<?php

namespace App\Services;

use App\Models\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function execute(int $id, array $data): void
    {
        $product = $this->productRepository->ofId($id);
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];

        $this->productRepository->update($product);
    }
}
