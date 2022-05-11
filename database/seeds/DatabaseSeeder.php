<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        if( $this->call(BackendUsersSeeder::class))
        $this->command->info('Table Backend Users seeded!');  
        
        if( $this->call(CategorySeeder::class))
        $this->command->info('Table Category seeded!');  
    }
}
