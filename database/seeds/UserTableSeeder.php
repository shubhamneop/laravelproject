<?php

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

        DB::table('users')->insert([ 'id'=>'01',
            'name'=>'Admin',
            'lastname'=>'Admin',
            'email'=>'shubham@gmail.com',
            'password'=>bcrypt('Admin123'),
            'status'=>'1',

        ] );
    }
}
