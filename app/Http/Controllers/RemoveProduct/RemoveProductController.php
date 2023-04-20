<?php

namespace App\Http\Controllers\RemoveProduct;

use App\Http\Controllers\Controller;
use App\Services\RemoveProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class RemoveProductController extends Controller
{
    private RemoveProductService $removeProductService;

    public function __construct(RemoveProductService $removeProductService)
    {
        $this->removeProductService = $removeProductService;
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->removeProductService->execute($id);

        return response()->json(['message' => 'Product removed successfully'], 200);
    }
}
