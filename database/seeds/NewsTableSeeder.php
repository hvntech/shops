<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\NewCategory;
use App\Models\News;
use App\Models\Partner;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->truncate();

        for ($i = 1; $i <= 10; $i++) {
            News::insert([
                'name' => 'category ' . $i,
                'description' => 'description ' . $i,
                'banner' => str_random(15),
                'news_categories_id' => NewCategory::all()->random()->id,
                'partner_id' => Partner::all()->random()->id,
                'delete_flag' => 0,
                'created_by' => User::all()->random()->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
