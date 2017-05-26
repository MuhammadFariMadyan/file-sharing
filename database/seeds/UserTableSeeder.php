<?php

use App\User;
use App\User\Role;
use App\User\RoleUser;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create default role
        Role::firstOrCreate([
            'name' => 'Uploader',
            'slug' => 'uploader',
            'permissions' => json_encode([
                'file.index' => true
                'file.upload' => true,
                'file.delete' => true,
                'report.create' => true,
            ]),
        ]);

        // create new role
        $role = Role::firstOrCreate([
            'name' => $name = 'Administrator',
            'slug' => str_slug($name),
            'permissions' => json_encode([])
        ]);

        // create new user
        $user = User::firstOrCreate([
            'name' => 'Super Administrator',
            'email' => 'admin@email.com',
            'password' => bcrypt('secret'),
        ]);

        // assign user to role
        $roleUser = RoleUser::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);
    }
}
