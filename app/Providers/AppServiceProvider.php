<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function(){
            $rule = Password::min(8);
            return $this->app->isProduction() ? $rule->mixedCase()->uncompromised():$rule;
        });

        // Gate::define('create-vehicle', function (User $user, Post $post) {
        //     return $user->id === $post->user_id;
        // });
    }
}
