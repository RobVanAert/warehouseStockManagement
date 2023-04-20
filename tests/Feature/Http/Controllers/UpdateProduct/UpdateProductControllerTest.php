<?php

namespace Http\Controllers\UpdateProduct;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateProductControllerTest extends TestCase
{
    use refreshDatabase;

    public function testUpdatesAProduct()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);

        $this->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('products', ['name' => 'test']);
    }

    public function testUpdatesAProductResponseHasMassage()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);

        $response = $this->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )
            ->assertStatus(Response::HTTP_OK);

        $this->assertStringContainsString('message', $response->getContent());
    }

    public function testUpdatesNoProduct()
    {
        $id = 9;

        $response = $this->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )
            ->assertStatus(Response::HTTP_NOT_FOUND);

        $this->assertStringContainsString('error', $response->getContent());
    }

    public function testUpdatesNoProductWithMissingData()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);

        $this->expectsDatabaseQueryCount(0);
        $this->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testReturnsErrorWithMissingData()
    {
        $id = 9;

        $response = $this->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('error', $response->getContent());
    }
}
