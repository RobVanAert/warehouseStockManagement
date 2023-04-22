<?php

namespace Http\Controllers\RemoveProduct;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RemoveProductControllerTest extends TestCase
{
    use refreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testDeletesAProduct()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);
        $this->actingAs($this->user)->delete('api/products/' . $id)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('products', ['id' => $id]);
    }

    public function testResponseContainsAMessageAfterDeleting()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);
        $response = $this->actingAs($this->user)->delete('api/products/' . $id)
            ->assertStatus(Response::HTTP_OK);

        $this->assertStringContainsString('message', $response->getContent());
    }

    public function testDoesNotDeleteWhenNotAuthenticated()
    {
        $id = 9;
        $this->deleteJson('api/products/' . $id)
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
