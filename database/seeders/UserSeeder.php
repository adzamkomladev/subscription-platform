<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

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
            ->flatten()->all();
            Log::info('subscriptions', ['subs' => $subscriptions, 'deliveries' => $deliveries]);

            User::factory()
                ->count(1)
                ->hasAttached($subscriptions)
                ->hasAttached($deliveries)
                ->create();
        }
    }
}
