<tr class="admin--articles--table--tbody--item">
    <td class="admin--articles--table--tbody--item__image">
        <div><img src="{{ url('/images'). '/' . $article->media->filename }}" width="50px" height="50px"/></div>
    </td>
    <td class="admin--articles--table--tbody--item__title">
        <div>{{ $article->title }}</div>
    </td>
    <td class="admin--articles--table--tbody--item__body">
        <div>{{ $article->body }}</div>
    </td>
    <td class="admin--articles--table--tbody--item__button">
        <form action="{{ route('admin.article.publish_unpublish', ['id' => $article->id]) }}" method="POST" style="display:inline-block">
            {{ csrf_field() }}
            @if ($article->published)
                <input type="hidden" name="status" value="0">
                <button class="btn btn-warning admin--articles--table--tbody--item__button-unpublish">Unpublish</button>
            @else
                <input type="hidden" name="status" value="1">
                <button class="btn btn-success admin--articles--table--tbody--item__button-publish">Publish</button>
            @endif
        </form>
        <form action="{{ route('admin.article.destroy', ['id' => $article->id]) }}" method="POST" style="display:inline-block">
            {{ csrf_field() }}

            <button class="btn btn-dager admin--articles--table--tbody--item__button-delete">Delete</button>
        </form>
    </td>
</tr>
