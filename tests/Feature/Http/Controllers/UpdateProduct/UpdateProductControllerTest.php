<?php

namespace Http\Controllers\UpdateProduct;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateProductControllerTest extends TestCase
{
    use refreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testUpdatesAProduct()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);

        $this->actingAs($this->user)->put(
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

        $response = $this->actingAs($this->user)->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10, 'description' => 'description']]
        )
            ->assertStatus(Response::HTTP_OK);

        $this->assertStringContainsString('message', $response->getContent());
    }

    public function testUpdatesNoProduct()
    {
        $id = 9;

        $response = $this->actingAs($this->user)->put(
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
        $this->actingAs($this->user)->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testReturnsErrorWithMissingData()
    {
        $id = 9;

        $response = $this->actingAs($this->user)->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10,]]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertStringContainsString('error', $response->getContent());
    }

    public function testDoesNotUpdateWhenNotAuthenticated()
    {
        $id = 9;

        $this->put(
            'api/products/' . $id,
            ['data' => ['name' => 'test', 'price' => 10,]],
            ['Accept' => 'application/json']
        )->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
