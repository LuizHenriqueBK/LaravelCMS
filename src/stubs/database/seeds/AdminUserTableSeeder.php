<?php

use App\Models\{User, Role, Media};
use Illuminate\{Http\File, Support\Str, Database\Seeder};

class AdminUserTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::whereName('administrator')->firstOrFail();

        $password = null;
        $repass = time();

        $name = $this->command->ask('What is your Name?');
        $email = $this->command->ask('What is your Email?');

        do {
            $password = $this->command->secret('create a password?');
            $repass = $this->command->secret('repeat password');
        } while ($password != $repass);

        $user = User::firstOrCreate(['email' => $email], [
            'name'           => $name,
            'password'       => bcrypt($password),
            'remember_token' => Str::random(60),
            'status'         => 1,
        ]);

        $user->roles()->sync($role);
        $user->avatar()->create([
            'directory' => 'avatars',
            'file' => new File(resource_path('admin/images/users/avatar.png')),
        ]);

        $this->command->line('User has been created');
        $this->command->info("User email: {$user->email}");
        $this->command->info("User password: {$password}");
    }
}
