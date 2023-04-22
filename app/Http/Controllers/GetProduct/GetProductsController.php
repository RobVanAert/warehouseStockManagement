<?php

namespace App\Http\Controllers\GetProduct;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Services\GetProductsPaginatedService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class GetProductsController extends Controller
{
    private GetProductsPaginatedService $getProductsPaginatedService;

    public function __construct(GetProductsPaginatedService $getProductsPaginatedService)
    {
        $this->getProductsPaginatedService = $getProductsPaginatedService;
    }

    public function __invoke(): ResourceCollection
    {
        return new ProductCollection($this->getProductsPaginatedService->execute());
    }
}
