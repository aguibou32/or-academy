<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        //
        $gate->define('isAdmin', function($user){
            return $user->profile_type == "Admin" || $user->email == "info@oracademy.co.za";
        });

        $gate->define('isLecturer', function($user){
            return $user->profile_type == "Lecturer";
        });

        $gate->define('isStudent', function($user){
            return $user->profile_type == "Student";
        });
    }
}
