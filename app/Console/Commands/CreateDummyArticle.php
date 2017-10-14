<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;

class CreateDummyArticle extends Command{

    protected $signature = 'create:dummy_article
                           {--total=100}
                           {--user_id=1}';
    protected $description = 'Create dummy article as you want';

    public function handle()
    {
        $total = (int) $this->option('total');
        $id = $this->option('user_id');

        factory(Article::class, $total)->create([
            'user_id' => $id
        ]);
        $this->info("Successfully Create {$total} Article");
    }
}

