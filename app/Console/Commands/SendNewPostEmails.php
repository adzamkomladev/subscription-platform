<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Notifications\NewPost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNewPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends new post mails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::where('created_at', '>', now()->subMinutes(1))
            ->with('website')
            ->get()
            ->each(function ($post) {
                Notification::send($post->website->subscribers, new NewPost($post));
            });

        return Command::SUCCESS;
    }
}
