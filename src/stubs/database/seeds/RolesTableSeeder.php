<?php

use Illuminate\Database\Seeder;
use App\Models\{Role, Permission};
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        Role::insert([
            [
                'title' => 'Administrator',
                'name' => 'administrator',
                'description' => 'Full access to create, read, update, delete and delete Mass',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'User',
                'name' => 'user',
                'description' => 'A standard user that can have a licence assigned to them. No administrative features.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

         //Role Administrator
        Role::findOrFail(1)->permissions()->sync(Permission::all());
    }
}
