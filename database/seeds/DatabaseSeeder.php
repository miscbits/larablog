<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = array(
                ['name' => 'Ryan Chenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret'), 'username' => 'RyanChenkie', 'confirmed' => 1, 'confirmation_code' => null, 'admin' => 1, 'deleted' => 0],
                ['name' => 'Chris Sevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret'), 'username' => 'ChrisSevilleja', 'confirmed' => 1, 'confirmation_code' => null, 'admin' => 0, 'deleted' => 0],
                ['name' => 'Holly Lloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret'), 'username' => 'HollyLloyd', 'confirmed' => 1, 'confirmation_code' => null, 'admin' => 0, 'deleted' => 0],
                ['name' => 'Adnan Kukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret'), 'username' => 'AdnanKukic', 'confirmed' => 1, 'confirmation_code' => null, 'admin' => 0, 'deleted' => 0],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

    }
}
