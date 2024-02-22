@extends('layouts')
@section('content')
    <div class="container" style="margin-top: 50px;">
        <h1>Личный кабинет пользователя {{ auth()->user()->name }}</h1>

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>Мои промокоды:</h2>
        <ul>
            @foreach ($promoCodes as $promoCode)
                <li class="list-group-item list-group-item-action list-group-item-primary">{{ $promoCode->code }}{{ $promoCode->promo_code_selection_date ?? 'Not Selected' }}</li>

            @endforeach
        </ul>
        <form method="post" action="{{ route('user.checkPromoCode') }}">
            @csrf
            <div class="form-group">
                <label for="promo_code">Введите промокод</label>
                <input type="text" class="form-control" id="promo_code" name="promo_code" required>
            </div>
            <button type="submit" class="btn btn-primary">Проверить</button>
        </form>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    </div>

@endsection
