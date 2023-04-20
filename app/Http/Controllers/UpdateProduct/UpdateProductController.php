<?php

namespace App\Http\Controllers\UpdateProduct;

use App\Http\Controllers\Controller;
use App\Services\UpdateProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UpdateProductController extends Controller
{
    private UpdateProductService $updateProductService;

    public function __construct(UpdateProductService $updateProductService)
    {
        $this->updateProductService = $updateProductService;
    }
    public function __invoke(int $id, UpdateProductRequest $updateProductRequest): JsonResponse
    {
        try {
            $this->updateProductService->execute($id, $updateProductRequest->get('data'));
            return response()->json(['message' => 'Product updated successfully'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'The product could not be found'], Response::HTTP_NOT_FOUND);
        }
    }
}
