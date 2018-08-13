<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where("name", "admin")->first();
        $role_faculty  = Role::where("name", "faculty")->first();
        $role_user  = Role::where("name", "user")->first();

    $admin = new User();
    $admin->name = "admin";
    $admin->email = "admin@gmail.com";
    $admin->password = bcrypt("admin123");
    $admin->save();
    $admin->roles()->attach($role_admin);

    $faculty = new User();
    $faculty->name = "faculty";
    $faculty->email = "faculty@gmail.com";
    $faculty->password = bcrypt("admin123");
    $faculty->save();
    $faculty->roles()->attach($role_faculty);

    $user = new User();
    $user->name = "user";
    $user->email = "user@gmail.com";
    $user->password = bcrypt("admin123");
    $user->save();
    $user->roles()->attach($role_user);
    }
}
