<?php

namespace App\Http\Controllers\AddProduct;

use App\Models\ProductRepository;
use App\Services\AddProductService;

class AddProductController
{
    private AddProductService $addProductService;

    public function __construct(AddProductService $addProductService)
    {
        $this->addProductService = $addProductService;
    }

    public function __invoke(AddProductRequest $addProductRequest)
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
