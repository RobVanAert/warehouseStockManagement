<?php

namespace Http\Controllers\AddProduct;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AddProductControllerTest extends TestCase
{
    use RefreshDatabase ;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testReturnsProductIdAfterAdding()
    {
        $expectedProductId = 1;
        $response = $this->actingAs($this->user)->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )->assertStatus(Response::HTTP_OK);

        $this->assertStringContainsString($expectedProductId, $response->getContent());
    }
    public function testAddsProduct()
    {
        $this->actingAs($this->user)->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseCount('products', 1);
    }

    public function testAddsNoProductWithMissingData()
    {
        $this->actingAs($this->user)->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertDatabaseCount('products', 0);
    }

    public function testReturnsErrorWithMissingData()
    {
        $response = $this->actingAs($this->user)->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('error', $response->getContent());
    }

    public function testDoesNotAddWhenNotAuthenticated()
    {
        $this->post(
            'api/products',
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']],
            ['Accept' => 'application/json']
        )->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
