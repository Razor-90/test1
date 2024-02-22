@extends('layouts')

@section('content')
    <div class="container text-center" style="margin-top: 50px;>
        <div class="row">
            <div class="col">
                <h1>Добро пожаловать на сайт с промокодами!</h1>
                @auth
                    <a href="{{ route('user.cabinet') }}">Личный кабинет</a>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                @else
                    <a class="btn btn-primary" href="{{ route('login') }}">Вход</a> |
                    <a class="btn btn-primary" href="{{ route('register') }}">Регистрация</a>
                @endauth
            </div>
        </div>
    </div>

@endsection
