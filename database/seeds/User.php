<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ismael Strey Pereira',
            'email' => 'ismaelstrey@hotmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
