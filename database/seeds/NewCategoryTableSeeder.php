<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\NewCategory;

class NewCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_categories')->truncate();

        for ($i = 1; $i <= 10; $i++) {
            NewCategory::insert([
                'category_name' => 'category ' . $i,
                'delete_flag' => 0,
                'created_by' => User::all()->random()->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
