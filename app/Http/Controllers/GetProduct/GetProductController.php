<?php

namespace App\Http\Controllers\GetProduct;

use App\Http\Controllers\Controller;
use App\Services\GetProductsPaginatedService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetProductController extends Controller
{
    private GetProductsPaginatedService $getProductsPaginatedService;

    public function __construct(GetProductsPaginatedService $getProductsPaginatedService)
    {
        $this->getProductsPaginatedService = $getProductsPaginatedService;
    }

    public function __invoke(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'paginated products',
                'data' =>$this->getProductsPaginatedService->execute()
            ],
            Response::HTTP_OK
        );
    }
}
