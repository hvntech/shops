<?php

use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\User;

class PartnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->truncate();

        for ($i = 1; $i <= 10; $i++) {
            Partner::insert([
                'name' => 'partner ' . $i,
                'logo' => 'logo',
                'banner' => 'banner ',
                'description' => 'description ',
                'delete_flag' => 0,
                'created_by' => User::all()->random()->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
