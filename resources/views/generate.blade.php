<img src="{!! public_path().'/images/'. $article->media->filename !!}" />
<h2>{{ $article->title }}</h2>
<span>{{ $article->publish_date }}</span>
<span> by {{ $article->user->name }}</span>
<div>{{ $article->body }}</div>
