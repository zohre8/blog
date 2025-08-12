<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);
    }
}
