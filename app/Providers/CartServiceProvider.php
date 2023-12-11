<?php
namespace App\Providers;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepository::class, function () {
            return new \App\Repositories\Cart\CartModelRepository();
        });
    }
    public function boot(): void
    {
    }
}
