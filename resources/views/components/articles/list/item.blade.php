<li class="list-group-item articles--list--item">
    <a class="articles--list--item__link" href="{{ route('home.read',['id' => $article->id] ) }}">
        <img class="articles--list--item__image" src="{{ url('/images'). '/' . $article->media->filename }}" width="50px" height="50px"/>
        <div>
            <h3 class="articles--list--item__title">{{ $article->title }}</h3>
            <span class="articles--list--item__publish-date">{{ $article->publish_date }}</span>
            <span class="articles--list--item__author"> by {{ $article->user->name }}</span>
        </div>
    </a>
</li>
