<tbody class="admin--articles--table--tbody">
    @foreach ($articles as $article)
        @component('components.admin.articles.table.tbody-item',[
            'article' => $article
            ])
        @endcomponent
    @endforeach
</tbody>
