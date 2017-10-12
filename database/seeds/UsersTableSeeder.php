<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() { 
        $options['name'] = 'admin';
        $options['email'] = 'admin@gmail.com';
        $options['password'] = '$2y$10$/E7Y59pTyet3B1ijdDf37eY.p1pUM5.5gdpf7ZA9D7uAMZSI97n6y';
        User::create($options);
    }

}
