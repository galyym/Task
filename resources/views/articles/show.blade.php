@extends('main.layout')

@section('page-title')
    Статья
@endsection

@section('content')
    <h1>{{ $article->title }}</h1>

    <div>
        <p>{!! $article->articleText !!}</p>
        <p>Дата создания: {{ $article->created_at }}</p>
    </div>

    @if(!Auth::guest())
        @if(Auth::user()->id == $article->user_id)
            <hr>

            <div class="row">
                <div class="col-2">
                    <a href="/articles/{{$article->id}}/edit" class="btn btn-warning">Редактировать</a>
                </div>
                <div class="col-3">
                    <form action="/articles/{{$article->id}}/delete" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @endif
    @endif
@endsection
