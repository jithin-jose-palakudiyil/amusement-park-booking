<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackendUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       if(DB::table('backend_users')->get()->count() == 0){
             $tasks =  [
                            [
                                'name' => 'admin',
                                'email' => 'admin@admin.com',
                                'status'=>'1',
                                'is_developer'=>'0', // this user is admin 
                                'password' => bcrypt('password'),
                            ],
                            [
                                'name' => 'developer',
                                'email' => 'dev@admin.com',
                                'status'=>'1',
                                'is_developer'=>'1', // this user is developer
                                'password' => bcrypt('password'),
                            ]
                        ];
             
             DB::table('backend_users')->insert($tasks);
         }
    }
}
