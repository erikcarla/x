<?php

namespace App\Builders;

use Carbon\Carbon;

class RssBuilder 
{
    public function show($articles)
    {
        $dataArticles = [];
        foreach($articles as $article)
        {
            $dataArticles[] = [
                'title' => $article->title,
                'link' => route('home.read', ['id' => $article->id]),
                'pubDate' => $article->publish_date,
                'author' => $article->user->name,
                'guid' => $article->id,
                'description' => $article->body,
                'mediaUrl' => url('/images'). '/' .$article->media->filename
            ];
        }

        return [
            'title' => 'Crossover RSS',
            'link' => getenv('APP_URL'),
            'description' => 'Crossover RSS update every 10 minutes',
            'lastBuildDate' => Carbon::now()->toDateTimeString(),
            'articles' => $dataArticles
        ];
    }
}
