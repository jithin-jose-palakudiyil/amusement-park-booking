<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         if(DB::table('category')->get()->count() == 0){
             $tasks =  [
                            [
                                'name' => 'Adult',
                                'slug' => 'adult',
                                'status'=>'1',   
                            ],
                            [
                                'name' => 'Child',
                                'slug' => 'child',
                                'status'=>'1',   
                            ],
                            [
                                'name' => 'Sr.Citizen',
                                'slug' => 'sr_citizen',
                                'status'=>'1',   
                            ],
                            [
                                'name' => 'Infant',
                                'slug' => 'infant',
                                'status'=>'1',   
                            ],
                        ];
             
             DB::table('category')->insert($tasks);
         }
    }
}
