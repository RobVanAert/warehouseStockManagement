<?php

namespace App\Providers;

use App\DatabaseProductRepository;
use App\Models\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepository::class, DatabaseProductRepository::class);
    }
}
