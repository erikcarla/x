@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Article
        </div>
        <div class="panel-body">
            @include('common.errors')
            @component('components.admin.articles.form')
            @endcomponent
        </div>
    </div>
@endsection
