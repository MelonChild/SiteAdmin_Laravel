<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //权限
        Gate::define('permission-check', function ($user, $permissionAlias='',$id=0) {

            //超级管理员，所有权限
            if($user->role_id==1){
               // return true;
            }

            //根据用户角色 获取权限
            $permissions = $user->role->permissions->pluck('the_alias')->toArray();
            if(in_array($permissionAlias,$permissions)){
                return true; 
            }

            //权限表不存在该记录，直接通过
            $permission = Permission::where('the_alias',$permissionAlias)->first();
            if(!$permission){
                return true;
            }

            return false;
        });
    }
}
