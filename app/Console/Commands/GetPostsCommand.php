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
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $data = $response->json();
        $posts = Post::all()->pluck('title');
        foreach ($data as $item) {
            if(!$posts->contains($item['title'])) {
                Post::create(['title' => $item['title'], 'description' => $item['body']]);
            }
        }
        $this->info('Посты синхронизированы');
        return 0;
    }
}
