<?php

namespace Services;

use App\Models\Product;
use App\Models\ProductRepository;
use App\Services\UpdateProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use Tests\TestCase;

class UpdateProductServiceTest extends TestCase
{
    private ProductRepository $productRepository;
    private UpdateProductService $updateProductService;

    public function setUp(): void
    {
        parent::setUp();
        $this->productRepository = Mockery::mock(ProductRepository::class);
        $this->updateProductService = new UpdateProductService($this->productRepository);
    }

    public function testUpdatesAProduct()
    {
        $id = 9;
        $product = Product::factory()->make(['id' => $id]);
        $data = [
            'name' => 'updatedName',
            'description' => 'updatedDesc',
            'price' => 89.36,
        ];
        $expectedProduct = Product::factory()->make(
            [
                'id' => $id,
                'name' => 'updatedName',
                'description' => 'updatedDesc',
                'price' => 89.36,
            ]
        );

        $this->productRepository->shouldReceive('ofId')
            ->with($id)
            ->once()
            ->andReturn($product);
        $this->productRepository->shouldReceive('update')
            ->with(
                Mockery::on(function ($product) use ($expectedProduct) {
                    $this->assertEquals($expectedProduct, $product);
                    return true;
                })
            )->once();
        $this->updateProductService->execute($id, $data);
    }

    public function testUpdatesNoProduct()
    {
        $id = 9;
        $data = [
            'name' => 'updatedName',
            'description' => 'updatedDesc',
            'price' => 89.36,
        ];

        $this->productRepository->shouldReceive('ofId')
            ->with($id)
            ->once()
            ->andThrows(ModelNotFoundException::class);
        $this->expectException(ModelNotFoundException::class);

        $this->updateProductService->execute($id, $data);
    }
}
