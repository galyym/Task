@extends('main.layout')

@section('page-title')
    Обновить статья
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Обновление статьи</h1>

    <form class="mx-auto" action="/articles/{{$article->id}}/edit" method="post">
        @csrf
        <div class="form-group mb-2">
            <label>Название статьи</label>
            <input type="text" class="form-control" name="title" placeholder="Название статьи" value="{{ $article->title }}">
        </div>
        <div class="form-group mb-2">
            <label>Cтатья</label>
            <textarea name="articleText" class="form-control d-block" cols="" rows="10" placeholder="Статья">{{ $article->articleText }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Обновить</button>
    </form>

@endsection
