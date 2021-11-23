<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $websites = Website::with('posts')->get();

        for ($i = 0; $i < 10; $i++) {
            $subscriptions = $websites->random(rand(1, $websites->count()));

            $deliveries = $subscriptions
                ->map(fn ($website) => $website->posts)
                ->flatten();

            User::factory()
                ->hasAttached($subscriptions, 'subscriptions')
                ->hasAttached($deliveries, 'deliveries')
                ->count(1)
                ->create();
        }
    }
}
