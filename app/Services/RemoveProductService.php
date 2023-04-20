<?php

namespace App\Services;

use App\Models\ProductRepository;

class RemoveProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(int $productId): void
    {
        $this->productRepository->remove($productId);
    }
}
