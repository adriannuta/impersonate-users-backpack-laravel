<?php

namespace MHMartinez\ImpersonateUser\app\Providers;

use Illuminate\Support\ServiceProvider;
use MHMartinez\ImpersonateUser\app\Http\Middleware\ImpersonateUserMiddleware;
use Illuminate\Contracts\Http\Kernel;

class ImpersonateUserServiceProvider extends ServiceProvider
{
    public const KEY = 'impersonate_user';

    public function boot(Kernel $kernel): void
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // Config
        $this->publishes([
            __DIR__ . '/../../config/impersonate_user.php' => config_path('impersonate_user.php'),
        ], 'config');

        // Translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'impersonate_user');
        $this->publishes([
            __DIR__ . '/../../resources/lang' => $this->app->langPath('vendor/impersonate_user'),
        ]);

        // Views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'impersonate_user');
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/impersonate_user'),
        ], 'views');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/impersonate_user.php', 'impersonate_user'
        );
    }
}
