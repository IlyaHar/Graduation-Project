@extends('layouts.main')

@section('title')
    Главная страница
@endsection

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1 class="main_title">Сокра.тим</h1>
        @guest()
            <p class="fs-5 mt-3 text-center">Вам нужно сделать ссылку? Прежде чем это сделать<br> зарегистрируйтесь на
                сайте</p>
            <form action="{{ route('auth.register') }}" method="POST" class="w-25" novalidate>
                @csrf
                <input type="email" name="email" class="form-control mt-4" placeholder="Введите email"
                       value="{{ old('email') }}">
                <input type="text" name="login" class="form-control  mt-3" placeholder="Введите логин"
                       value="{{ old('login') }}">
                <input type="password" name="password" class="form-control mt-3" placeholder="Введите пароль"
                       value="{{ old('password') }}">
                @include('blocks.messages')
                <button type="submit" class="mt-3 btn btn-danger">Зарегистрироваться</button>
            </form>
            <a href="{{ \App\Services\GoogleService::link() }}">
                <div class="mt-5 border border-secondary pt-4 pb-1 px-5 border-2 rounded-2">
                    <b><p class="text-dark fs-5">Авторизоваться через <img class="social_icon" src="/storage/images/google.svg" alt=""></p>
                    </b>
                </div>
            </a>
            <a href="{{ route('github.redirect') }}">
                <div class="mt-3 border border-secondary pt-4 pb-1 px-5 border-2 rounded-2">
                    <b><p class="text-dark fs-5">Авторизоваться через <img class="social_icon" src="/storage/images/github.svg" alt=""></p>
                    </b>
                </div>
            </a>
            <p class="mt-4">Есть аккаунт? Тогда вы можете <a href="{{ route('auth.index') }}" class="text-primary">авторизоваться</a>
            </p>
        @endguest
        @auth()
            <p class="fs-5 mt-3 text-center">Вам нужно сократить ссылку? Сейчас мы это сделаем</p>
            <form action="{{ route('link.store') }}" method="POST" class="w-25" novalidate>
                @csrf
                <input type="text" name="link" class="form-control mt-4" placeholder="Длинная ссылка"
                       value="{{ old('link') }}">
                <input type="text" name="title" class="form-control  mt-3" placeholder="Короткое название"
                       value="{{ old('title') }}">
                @include('blocks.messages')
                <button type="submit" class="mt-3 btn btn-danger">Уменьшить</button>
            </form>

            @php($links = \Illuminate\Support\Facades\Auth::user()->links)

            <div class="mt-4">
                @foreach($links as $link)
                    <div class="link_card bg-secondary-subtle mt-3">
                        <p>Длинная: {{ $link->link }}</p>
                        <p>Короткая: <a target="_blank" href="{{ $link->link }}">{{ $link->title }}</a></p>
                        <form action="{{ route('link.delete', $link->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endauth
    </div>
@endsection
