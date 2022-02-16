<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'phongadmin',
            'admin_email' => 'phongadmin@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456'),
        ]);

        $author = Admin::create([
            'admin_name' => 'phongauthor',
            'admin_email' => 'phongauthor@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456'),
        ]);

        $user = Admin::create([
            'admin_name' => 'phonguser',
            'admin_email' => 'phonguser@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456'),
        ]);
        $user = Admin::create([
            'admin_name' => 'thinhuser',
            'admin_email' => 'thinhuser@gmail.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456'),
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

        /* factory(App\Models\Admin::class, 20)->create(); */

    }

}
