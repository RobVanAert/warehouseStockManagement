<?php

namespace Services;

use App\Models\ProductRepository;
use App\Services\GetProductsPaginatedService;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class GetProductsPaginatedServiceTest extends TestCase
{
    private ProductRepository $productRepository;
    private GetProductsPaginatedService $getProductsPaginatedService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productRepository = Mockery::mock(ProductRepository::class);
        $this->getProductsPaginatedService = new GetProductsPaginatedService($this->productRepository);
    }

    public function testGetsPaginatedProducts()
    {
        $expectedPaginatedProducts = new LengthAwarePaginator([], 0, 10);
        $this->productRepository->shouldReceive('getPaginated')
            ->withNoArgs()
            ->once()
            ->andReturn($expectedPaginatedProducts);

        $paginatedProducts = $this->getProductsPaginatedService->execute();

        $this->assertEquals($expectedPaginatedProducts, $paginatedProducts);
    }
}
