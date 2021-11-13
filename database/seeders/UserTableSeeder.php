<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         User::truncate();
         DB::table('roles_user')->truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = User::create([
           'name' => 'TrongAd',
           'email' => 'trongad@gmail.com',
           'password' => hash::make('123456789'), 
        ]);

        $author = User::create([
            'name' => 'TrongAuthor',
            'email' => 'trongAuthor@gmail.com',
            'password' => hash::make('123456789'), 
         ]);

         $user = User::create([
            'name' => 'TrongUser',
            'email' => 'trongUser@gmail.com',
            'password' => hash::make('123456789'), 
         ]);

         $admin->roles()->attach($adminRoles);
         $author->roles()->attach($authorRoles);
         $user->roles()->attach($userRoles);

         $faker_users = User::factory()->count(15)->create();
         foreach($faker_users as $faker_user){
            $faker_user->roles()->attach($userRoles);
         }
    }
}
