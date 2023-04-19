<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductRepository;

class AddProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(array $data): Product
    {
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];

        return $this->productRepository->add($product);
    }
}
