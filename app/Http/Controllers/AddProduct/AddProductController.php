<?php

namespace App\Http\Controllers\AddProduct;

use App\Http\Controllers\Controller;
use App\Services\AddProductService;
use Illuminate\Http\JsonResponse;

class AddProductController extends Controller
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
