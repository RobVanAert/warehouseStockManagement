<?php

namespace Http\Controllers\GetProducts;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetProductsControllerTest extends TestCase
{
    use refreshDatabase;

    public function testGetsProductsPaginated()
    {
        Product::factory()->count(10)->create();

        $this->get('api/products')
            ->assertStatus(200);
    }

    public function testGetsSecondProductsPage()
    {
        Product::factory()->count(15)->create();

        $response = $this->get('api/products?page=2')
             ->assertStatus(200);

        $this->assertSame(2, $response->json('meta')['current_page']);
    }
}
