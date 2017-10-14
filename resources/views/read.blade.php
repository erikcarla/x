@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @component('components.articles.readpage',[
                    'article' => $article
                ])
            @endcomponent
        </div>
    </div>
@endsection
