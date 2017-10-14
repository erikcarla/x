<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->truncate();

        factory(Article::class, 10)->create();
        factory(Article::class, 10)->create([
            'published' => true,
            'publish_date' => Carbon::now(),
        ]);
    }

}
