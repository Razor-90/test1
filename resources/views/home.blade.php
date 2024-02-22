@extends('layouts')

@section('content')
<!--
    <div class="container" style="margin-top: 100px;">
        <div class="row" style="text-align:center;">
			     <div class="col-md-3">
					 </div>
			 <div class="col-md-6">
            <h1>Добро пожаловать, {{ auth()->user()->name }}!</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

				<h2>Введите код</h2>
                <form method="post" action="{{ route('user.checkPromoCode') }}">
                    @csrf

                    <input type="text" class="form-control" placeholder="Введите промокод" aria-label="Введите промокод"  id="promo_code" name="promo_code"  aria-describedby="button-addon2" required style="width: 30%; margin: 0 auto;">
                    <button class="btn btn-success" type="submit" id="button-addon2" style="margin: 20px auto;border-radius: 50%;width: 50px;height: 50px;font-weight: bold;font-size: 25px;">+</button>

                </form>


                <h2>Мои промокоды:</h2>
                <ul style="font-weight: bold;text-align:left;">
                @foreach ($promoCodes as $key => $promoCode)
                    <li class="list-group-item list-group-item-action {{ $promoCode->is_winned ? 'list-group-item-success' : 'list-group-item-success' }}">
                        {{ $key + 1 }}. {{ $promoCode->code }} | {{ $promoCode->promo_code_selection_date ?? 'Not Selected' }}
                        @if ($promoCode->is_winned && !$promoCode->prize_received)
                            <span class="badge bg-success">Вы выиграли моментальный приз
                                @if (!empty($promoCode->prize))
                                    <span>{{ $promoCode->prize }}</span> пройдите по адресу
                                @else
                                    пройдите по адресу
                                @endif
                            </span><br>
                            <span class="badge bg-danger text-white">Приз не получен</span>
                        @elseif ($promoCode->is_winned && $promoCode->prize_received)
                            <span class="badge bg-success">Приз получен</span>
                        @endif
                    </li>
                @endforeach
                </ul>
        <form method="post" action="{{ route('logout') }}"style="text-align: center;">
                @csrf
        <button type="submit" class="btn btn-primary">Выйти</button>
        @if(auth()->user() && auth()->user()->isAdmin())
            <a class="btn btn-primary" href="{{ route('admin.promo_codes.index') }}">Админ</a>
        @endif
        </form>
	</div>


  <div class="col-md-3">   </div>


</div></div>


-->
<hr>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Добро пожаловать, {{ auth()->user()->name }}!</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h2>Введите код</h2>
            <form method="post" action="{{ route('user.checkPromoCode') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Введите промокод" aria-label="Введите промокод"  id="promo_code" name="promo_code" aria-describedby="button-addon2" required>
                    <button class="btn btn-success" type="submit" id="button-addon2">+</button>
                </div>
            </form>

            <h2>Мои промокоды:</h2>
            <ul class="list-group">
                @foreach ($promoCodes as $key => $promoCode)
                    <li style="font-weight: bold;" class="list-group-item list-group-item-action {{ $promoCode->is_winned ? 'list-group-item-success' : 'list-group-item-info' }}" style="cursor: pointer;">
                        {{ $key + 1 }}. {{ $promoCode->code }} | {{ $promoCode->promo_code_selection_date ?? 'Not Selected' }}
                        @if ($promoCode->is_winned && !$promoCode->prize_received)
                            <span class="badge bg-success">Вы выиграли моментальный приз
                                @if (!empty($promoCode->prize))
                                    <span>{{ $promoCode->prize }}</span> пройдите по адресу
                                @else
                                    пройдите по адресу
                                @endif
                            </span><br>
                            <span class="badge bg-danger text-white">Приз не получен</span>
                        @elseif ($promoCode->is_winned && $promoCode->prize_received)
                            <span class="badge bg-success">Приз получен</span>
                        @endif
                    </li>
                @endforeach
            </ul>

            <form method="post" action="{{ route('logout') }}" class="text-center mt-3">
                @csrf
                <button type="submit" class="btn btn-primary">Выйти</button>
                            @if(auth()->user() && auth()->user()->isAdmin())
                <a class="btn btn-primary" href="{{ route('admin.promo_codes.index') }}">Админ</a>
            @endif
            </form>
        </div>
    </div>
</div>


@endsection
