@extends('main.layout')
@extends('articles.tag')

@section('page-title')
    Главная страница
@endsection

@section('content')
    <h1>Все статьи на сайте</h1>

        @forelse($articles as $ar)
                <div class="well">
                    <a href="/articles/{{ $ar->id }}"><h3>{{ $ar->title }}</h3></a>
                </div>
        @empty
            <p class="text-center">
                По вашему запросу: <strong>{{ request()->query('search') }} </strong>ничего не найдено
            </p>
        @endforelse

@endsection

@section('search')
    <form class="form-inline my-2 my-lg-0 d-flex" action="{{ route('home') }}" method="get">
        <input class="form-control mr-sm-2 mr-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->query('search') }}">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>
@endsection

@section('tag')
    <h5 class="mt-3">Tags</h5>
    <form class="form-group" action="{{ route('tag.show') }}" method="get">
        @foreach($tag as $t)
            <button type="submit" class="btn btn-primary">
                {{$t->name}}
            </button>
        @endforeach
    </form>
@endsection





