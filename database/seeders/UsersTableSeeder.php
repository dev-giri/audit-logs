<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'dev.giridhari@gmail.com',
                'avatar' => '',
                'password' => Hash::make('123456'),
                'is_admin' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Dev',
                'email' => 'dev.test@gmail.com',
                'avatar' => '',
                'password' => Hash::make('123456'),
                'is_admin' => 0,
            ),
        ));
        
        
    }
}