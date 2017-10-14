@if (isset($articles) && count($articles) > 0)
    <ul class="list-group articles--list">
        @foreach ($articles as $article)
            @component('components.articles.list.item',[
                    'article' => $article
                ])
            @endcomponent
        @endforeach
    </ul>
@endif
