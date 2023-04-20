<?php

namespace Http\Controllers\RemoveProduct;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RemoveProductControllerTest extends TestCase
{
    use refreshDatabase;

    public function testDeletesAProduct()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);
        $this->delete('api/products/' . $id)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('products', ['id' => $id]);
    }

    public function testReponseContainsAMessageAfterDeleting()
    {
        $id = 9;
        Product::factory()->create(['id' => $id]);
        $response = $this->delete('api/products/' . $id)
            ->assertStatus(Response::HTTP_OK);

        $this->assertStringContainsString('message', $response->getContent());
    }
}
