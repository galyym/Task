@extends('main.layout')

@section('page-title')
    Создать пользователя
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

    <h1>Создание новой статьи</h1>

    <form class="mx-auto" action={{ route('articles.store') }} method="post">
        @csrf
        <div class="form-group mb-2">
            <label>Название статьи</label>
            <input type="text" class="form-control" name="title" placeholder="Название статьи">
        </div>
        <div class="form-group mb-2">
            <label>Cтатья</label>
            <textarea name="articleText" class="form-control d-block" cols="" rows="10" placeholder="Статья"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Добавить</button>
    </form>
@endsection
