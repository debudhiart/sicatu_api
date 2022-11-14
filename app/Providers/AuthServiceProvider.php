<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


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
        // Gate::define('crate-delete-users', function(User $user){
        //     if($user->roles_id===1){
        //         return true;
        //     }
        // }); 
        Gate::define('super-admin', function(User $user){
            // return '1';
            if($user->roles_id===1){
                return true;
            }
        });
        
        // Gate::define('super-admin-operator1', function(User $user){
            //     if($user->roles_id===1 || $user->roles_id===2){
                //         return true;
                //     }
                // });
                
        Gate::define('super-admin-operator', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2){
                return true;
            }
        });
        Gate::define('super-admin-operator-perangkat-desa', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2 || $user->roles_id===3){
                return true;
            }
        });

        Gate::define('super-admin-operator-perangkat-desa-petugas', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2 || $user->roles_id===3 || $user->roles_id===4){
                return true;
            }
        });

        Gate::define('super-admin-operator-perangkat-desa-pelanggan', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2 || $user->roles_id===3 || $user->roles_id===5){
                return true;
            }
        });

        Gate::define('super-admin-operator-perangkat-desa-petugas-pelanggan', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2 || $user->roles_id===3 || $user->roles_id===4 || $user->roles_id===5){
                return true;
            }
        });

        Gate::define('super-admin-operator-petugas', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2 || $user->roles_id===4){
                return true;
            }
        });
        
        Gate::define('super-admin-operator-pelanggan', function(User $user){
            // return 'ok';
            if($user->roles_id===1 || $user->roles_id===2 || $user->roles_id===5){
                return true;
            }
        });
        

        //
    }
}
