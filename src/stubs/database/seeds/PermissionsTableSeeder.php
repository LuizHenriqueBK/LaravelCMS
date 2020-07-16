<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\{Str, Facades\Schema};

class PermissionsTableSeeder extends Seeder
{
    /**
     * The modules default.
     *
     * @var string
     */
    protected $modules = ['user', 'role', 'permission'];

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        Permission::insert([
            'title' => "dashboard",
            'name' => "dashboard",
            'description'=> "View Dashboard",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($this->modules as $module) {

            $module = Str::plural($module);

            Permission::insert([
                [
                    'title' => "{$module} read",
                    'name' => "{$module}.read",
                    'description'=> "View {$module}",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => "{$module} create",
                    'name' => "{$module}.create",
                    'description'=> "Create {$module}",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => "{$module} update",
                    'name' => "{$module}.update",
                    'description'=> "Edit {$module}",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => "{$module} delete",
                    'name' => "{$module}.delete",
                    'description'=> "Delete {$module}",
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => "{$module} deleteMass",
                    'name' => "{$module}.deleteMass",
                    'description'=> "Delete Mass {$module}",
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}
