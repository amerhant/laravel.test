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
        $options['password'] = Hash::make('123456');
        User::create($options);
    }

}
