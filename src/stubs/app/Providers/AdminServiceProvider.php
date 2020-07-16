<?php

namespace App\Providers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\{ServiceProvider, Str};
use Illuminate\Support\Facades\{DB, Gate, Route, Schema};

class AdminServiceProvider extends ServiceProvider
{
    /**
     * The path to the "dashboard" route for your application.
     *
     * @var string
     */
    public const ADMIN = '/admin/dashboard';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    public const NAMESPACE = 'App\Http\Controllers\Admin';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMacros();

        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->makeGatesPermissions();
        $this->loadViewsFrom(resource_path('admin/views'), 'Admin');
        $this->loadRoutesFrom(base_path('routes/admin.php'));

        //
    }

    /**
     * booting Gates for Users.
     * @return bollean
     */
    private function makeGatesPermissions()
    {
        if (!$this->app->runningInConsole()) {
            try {
                if (Schema::hasTable('permissions')) {
                    $permissions = cache()->rememberForever('permissions.name', function () {
                        return DB::table('permissions')->get(['name']);
                    });
                    foreach ($permissions as $permission) {
                        Gate::define($permission->name, function ($user) use ($permission) {
                            return ($user->isAdmin() || $user->hasPermission($permission->name));
                        });
                    }
                }
            } catch (QueryException $e) {
                return;
            }
        }
    }

    /**
     * Register Routes Macros.
     * @return bollean
     */
    protected function registerMacros()
    {
        if (!Route::hasMacro('module')) {
            Route::macro('module', function ($name) {
                $module = strtolower($name);
                $prefixController = Str::singular(ucfirst($module));
                Route::resource($module, "{$prefixController}Controller");
                Route::delete("{$module}/bulkDelete", "{$prefixController}Controller@destroyMass")->name("{$module}.bulkDelete");
            });
        }
    }
}
