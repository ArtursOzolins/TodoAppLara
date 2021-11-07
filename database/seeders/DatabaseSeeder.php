<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
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
        User::factory(2)->create(
            ['password' => bcrypt('12345678')]
        )->each(function(User $user){
            Task::factory(15)->create([
                'user_id' => $user->id,
                'completed_at' => null,
                'recycled' => 'no'
            ]);
        });
    }
}
