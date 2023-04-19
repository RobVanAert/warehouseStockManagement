<?php

namespace App\Http\Controllers\AddProduct;

use App\Models\ProductRepository;
use App\Services\AddProductService;
use Illuminate\Http\JsonResponse;

class AddProductController
{
    private AddProductService $addProductService;

    public function __construct(AddProductService $addProductService)
    {
        $this->addProductService = $addProductService;
    }

    public function __invoke(AddProductRequest $addProductRequest): JsonResponse
    {
        $product = $this->addProductService->execute($addProductRequest->get('data'));

        return response()->json([
            'message' => 'Product added successfully',
            'data' => [
                'id' => $product->id,
            ]
        ]);
    }
}
