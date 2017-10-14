@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <a href="{{ route('admin.article.create') }}" class="btn btn-info" id="create-article">Create Article</a>
    </div>

    @component('components.admin.articles.table', [
            'articles' => $articles
        ])
    @endcomponent
@endsection
