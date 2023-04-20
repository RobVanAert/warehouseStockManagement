<?php

namespace Services;

use App\Models\Product;
use App\Models\ProductRepository;
use App\Services\RemoveProductService;
use Mockery;
use Tests\TestCase;

class RemoveProductServiceTest extends TestCase
{
    private ProductRepository $productRepository;
    private RemoveProductService $removeProductService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productRepository = Mockery::mock(ProductRepository::class);
        $this->removeProductService = new RemoveProductService($this->productRepository);
    }

    public function testRemovesAProduct()
    {
        $id = 89;
        $this->productRepository->shouldReceive('remove')
            ->with($id)
            ->once();

        $this->removeProductService->execute($id);
    }
}
