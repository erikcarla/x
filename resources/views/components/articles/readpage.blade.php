<div class="articles--readpage">
    <img class="articles--readpage__image" src="{{ url('/images'). '/' . $article->media->filename }}" />
    <h3 class="articles--readpage__title">{{ $article->title }}</h3>
    <div>
        <span class="articles--readpage__publish-date">{{ $article->publish_date }}</span>
        <span class="articles--readpage__author"> by {{ $article->user->name }}</span>
    </div>
    <br/>
    <div>
        <span class="articles--readpage__body">{{ $article->body }}</span>
    </div>

    <a class="btn btn-info articles--readpage__generate" target="_blank" href={{ route('home.generate', ['id' => $article->id]) }}>Generate as PDF</a>
</div>
