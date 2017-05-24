<?php

use Illuminate\Database\Seeder;

class UserEventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_event_registrations')->truncate();

        for ($i = 0; $i < 10; $i++) {
            DB::table('user_event_registrations')->insert([
                'users_id' => \App\Models\User::all()->random()->id,
                'events_id' => \App\Models\Event::all()->random()->id,
                'name' => 'name' . $i,
                'email' => 'email' . $i . '@gmail.com',
                'contact_number' => '012345678',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
