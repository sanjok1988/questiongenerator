<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = "admin";
        $role_admin->description = "Highly Authorized";
        $role_admin->save();

        $role_faculty = new Role();
        $role_faculty->name = "faculty";
        $role_faculty->description = "normal authorized";
        $role_faculty->save();

        $role_user = new Role();
        $role_user->name = "user";
        $role_user->description = "minimal authorized";
        $role_user->save();
    }
}
