<?php

namespace App\Services;

use App\Models\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class GetProductsPaginatedService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): LengthAwarePaginator
    {
        return $this->productRepository->getPaginated();
    }
}
