<li class="list-group-item articles--list--item">
    <a class="articles--list--item__link row" href="{{ route('home.read',['id' => $article->id] ) }}">
        <div class="col-md-2">
            <img class="articles--list--item__image" src="{{ url('/images'). '/' . $article->media->filename }}" width="100px" height="100px"/>
        </div>
        <div class="col-md-10">
            <h3 class="articles--list--item__title">{{ $article->title }}</h3>
            <span class="articles--list--item__publish-date">{{ $article->publish_date }}</span>
            <span class="articles--list--item__author"> by {{ $article->user->name }}</span>
        </div>
    </a>
</li>
