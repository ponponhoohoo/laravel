<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $param = [
           'name' => '伊藤博文',
           'email' => '1',
           'password' => 'sasasasasasa'
       ];
       DB::table('users')->insert($param);
    }
}
