<?php

namespace App\Providers;

use App\Models\Product;
use App\Services\PermissionGateAndPolicyAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\callback;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
       $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
       $permissionGateAndPolicy->setGateAndPolicyAccess();




//        Gate::define('category-list', function ($user) {
//            return $user->checkPermissionAccess(config('permissions.access.list-category'));
//        });


        Gate::define('product-edit', function ($user, $id) {
            $product=Product::find($id);
            if ($user->checkPermissionAccess('product_edit') && $user->id === $product->user_id){
                return true;
            }
            return false;
        });

        Gate::define('product-list', function ($user) {
            return $user->checkPermissionAccess('product_list');
        });
        Gate::define('product-add', function ($user) {
            return $user->checkPermissionAccess('product_add');
        });
        Gate::define('product-delete', function ($user) {
            return $user->checkPermissionAccess('product_delete');
        });
    }

}
