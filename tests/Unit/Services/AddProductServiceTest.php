<?php

namespace Services;

use App\Models\Product;
use App\Models\ProductRepository;
use App\Services\AddProductService;
use Mockery;
use Tests\TestCase;

class AddProductServiceTest extends TestCase
{
    private ProductRepository $productRepository;
    private AddProductService $addProductService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepository = Mockery::mock(ProductRepository::class);
        $this->addProductService = new AddProductService($this->productRepository);
    }

    public function testAddsAProduct()
    {
        $data = [
            'name' => 'Test Product',
            'price' => 100,
            'description' => 'Test Description',
        ];
        $expectedProduct = Product::factory()->make($data);

        $this->productRepository->shouldReceive('add')
           ->with(Mockery::on(function ($product) use ($data) {
               $this->assertEquals($data['name'], $product->name);
               $this->assertEquals($data['price'], $product->price);
               $this->assertEquals($data['description'], $product->description);
               return true;
           }))
            ->andReturn($expectedProduct);

        $product = $this->addProductService->execute($data);

        $this->assertEquals($expectedProduct, $product);
    }
}
