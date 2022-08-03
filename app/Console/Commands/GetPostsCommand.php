<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetPostsCommand extends Command
{
    protected $signature = 'posts:get';

    protected $description = 'Получить посты с jsonplaceholder';

    public function handle()
    {
        Post::truncate();
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();
        $this->withProgressBar($posts, function($post) {
            Post::create(['title' => $post['title'], 'description' => $post['body']]);
        });
        $this->newLine();
        $this->info('Посты были добавлены');
        return 0;
    }
}
