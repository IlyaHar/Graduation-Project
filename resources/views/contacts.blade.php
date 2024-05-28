@extends('layouts.main')

@section('title') Обратная связь @endsection

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1 class="main_title">Обратная связь</h1>
        <p class="fs-5 mt-3 text-center">Напишите нам, если у вас есть вопросы</p>
        <form action="{{ route('contacts.store') }}" method="POST" class="w-25" novalidate>
            @csrf
            <input type="text" name="name" class="form-control  mt-4" placeholder="Введите имя" value="{{ old('name', \Illuminate\Support\Facades\Auth::user()->login ?? '') }}">
            <input type="email" name="email" class="form-control mt-3" placeholder="Введите email" value="{{ old('email', \Illuminate\Support\Facades\Auth::user()->email ?? '') }}" >
            <input type="number" name="age" class="form-control mt-3" placeholder="Введите возвраст" value="{{ old('age') }}">
            <textarea name="message" class="form-control mt-3" cols="30" rows="10" placeholder="Введите само сообщение" >{{ old('message') }}</textarea>
            @include('blocks.messages')
            <button type="submit" class="mt-3 btn btn-danger">Отправить</button>
        </form>
    </div>
@endsection
