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
        DB::table('users')->truncate();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => 'user name ' . $i,
                'mobile_phone' => '09898989',
                'delete_flag' => 0,
                'email' => 'admin' . $i . '@gmail.com',
                'password' => bcrypt('admin'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
