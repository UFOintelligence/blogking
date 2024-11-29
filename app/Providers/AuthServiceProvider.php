<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\support\facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();



        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Administrador') ? true : null;
        });

        Gate::define('edit-post', function ($user, Post $post) {
            // El usuario puede editar si es el autor del post o tiene los roles de administrador/super
            // administrador
            return $user->id === $post->user_id || in_array($user->role, ['administrador', 'super administrador']);
        });
    

    }
}
