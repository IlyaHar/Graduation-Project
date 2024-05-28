@extends('layouts.main')

@section('title') Авторизация @endsection

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1 class="main_title">Авторизация</h1>
        <p class="fs-5 mt-3 text-center">Здесь вы можете авторизоваться на сайте</p>
        <form action="{{ route('auth.login') }}" method="POST" class="w-25">
            @csrf
            <input type="text" name="login" class="form-control  mt-3" placeholder="Введите логин" value="{{ old('login') }}">
            <input type="password" name="password" class="form-control mt-3" placeholder="Введите пароль" >
            @include('blocks.messages')
            <button type="submit" class="mt-3 btn btn-danger">Войти</button>
        </form>
    </div>
@endsection
