<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_admin', function ($user) {
            return in_array($user->email,[
                'nathanmroque@gmail.com',
                'deynichkax@gmail.com',
                'ra.larmonie@gmail.com',
                'janedoe@test.com'
            ]);
        });

        Gate::define('edit-delete-comment', function ($user, $comment) {
            return in_array($user->email,[
                'nathanmroque@gmail.com',
                'deynichkax@gmail.com',
                'ra.larmonie@gmail.com',
                'janedoe@test.com'
            ]) || $user->id === $comment->user_id ;
        });

        Gate::define('edit-profile', function ($user, $user_2) {
            return in_array($user->email,[
                'nathanmroque@gmail.com',
                'deynichkax@gmail.com',
                'ra.larmonie@gmail.com',
                'janedoe@test.com'
            ]) || $user->id === $user_2->id ;
        });
    }
}
