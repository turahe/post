<?php

namespace Turahe\Post;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/post.php', 'post');

        if ($this->app instanceof \Illuminate\Foundation\Application) {
            $databasePath = __DIR__.'/../database/migrations';
            $this->loadMigrationsFrom($databasePath);

            $this->publishes(
                [
                    __DIR__.'/../config/post.php' => config_path('post.php'),
                ],
                'config'
            );
        }
    }
}
