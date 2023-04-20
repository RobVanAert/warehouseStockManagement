<?php

namespace Http\Controllers\AddProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AddProductControllerTest extends TestCase
{
    use RefreshDatabase ;
    public function testReturnsProductIdAfterAdding()
    {
        $expectedProductId = 1;
        $response = $this->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )->assertStatus(Response::HTTP_OK);

        $this->assertStringContainsString($expectedProductId, $response->getContent());
    }
    public function testAddsProduct()
    {
        $this->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseCount('products', 1);
    }

    public function testAddsNoProductWithMissingData()
    {
        $this->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

       $this->assertDatabaseCount('products', 0);
    }

    public function testReturnsErrorWithMissingData()
    {
        $response = $this->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('error', $response->getContent());
    }
}

