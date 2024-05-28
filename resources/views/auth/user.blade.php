@extends('layouts.main')

@section('title') Личный кабинет @endsection

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1 class="main_title">{{ \Illuminate\Support\Facades\Auth::user()->login }}</h1>
        <a href="{{ route('auth.logout') }}" class="btn btn-danger">Выйти</a>
    </div>
@endsection
