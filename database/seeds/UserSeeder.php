<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'im@phoc.ru',
            'password' => '$2y$10$T/pb6IbqgYQQPsoSw1SH/u1JL97LqHsz9Mba7LF1IwbcONQ0eHToe',
            'bill' => '410011502711398'
        ]);
    }
}
