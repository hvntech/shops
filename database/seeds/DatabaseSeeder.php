<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(PartnerTableSeeder::class);
        $this->call(NewCategoryTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}
