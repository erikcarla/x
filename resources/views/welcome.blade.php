@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @component('components.articles.list',[
                    'articles' => $articles
                ])
            @endcomponent
        </div>
    </div>
@endsection
