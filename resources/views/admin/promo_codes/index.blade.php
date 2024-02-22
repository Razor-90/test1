@extends('layouts.admin')

@section('content')
    <h1>Промокоды</h1>

    <div class="container">
        <label for="cityFilter">Фильтр по городу:</label>
        <select id="cityFilter" class="form-control">
            <option value="">Все города</option>
            @foreach ($usedPromoCodes->unique('user.city') as $promoCode)
                @php
                    $city = $promoCode->user->city ?? 'N/A';
                @endphp
                <option value="{{ $city }}">{{ $city }}</option>
            @endforeach
        </select>
    </div>

    <div class="container">
        <label for="search">Поиск:</label>
        <input type="text" id="search" class="form-control">
    </div>

     <div class="container">
        <form action="{{ route('promo_codes.export') }}" method="GET">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Выгрузить</button>
        </form>
    </div>
<hr>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>№</th>
            <th>Код</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Город</th>
            <th>Дата</th>
            <th>Выигрыш</th>
            <th>Приз</th>
            <th>Выигрыш получен</th>
        </tr>
        </thead>
        <tbody>
        <form method="POST" action="{{ route('update.prize.received') }}">
            @csrf
            @foreach ($usedPromoCodes as $key => $promoCode)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $promoCode->code }}</td>
                    <td>{{ $promoCode->user->name ?? 'N/A' }}</td>
                    <td>{{ $promoCode->user->phone ?? 'N/A' }}</td>
                    <td>{{ $promoCode->user->city ?? 'N/A' }}</td>
                    <td>{{ $promoCode->promo_code_selection_date ?? 'Not Selected' }}</td>
                    <td>{{ $promoCode->prize }}</td>
                    <td style="background: {{ $promoCode->is_winned == 1 ? 'green' : 'red' }}">{{ $promoCode->is_winned == 1 ? 'Won' : 'Not Selected' }}</td>
                    <td>
                        <input type="hidden" name="prize_received[{{ $promoCode->id }}]" value="0">
                        <input type="checkbox" name="prize_received[{{ $promoCode->id }}]" value="1" {{ $promoCode->prize_received ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="container text-right mb-3">
        <button type="submit" class="btn btn-primary">Обновить список</button>
    </div>
</form>

    <a  class="btn btn-primary" href="{{ route('home') }}">Назад</a>

<hr>


    <script>
        document.getElementById('cityFilter').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('search').addEventListener('input', function() {
            filterTable();
        });

        function filterTable() {
            var selectedCity = document.getElementById('cityFilter').value.trim().toLowerCase();
            var searchString = document.getElementById('search').value.trim().toLowerCase();
            var rows = document.querySelectorAll('tbody tr');

            rows.forEach(function(row) {
                var cityCell = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                var searchCells = Array.from(row.querySelectorAll('td')).slice(1, -1).map(cell => cell.textContent.trim().toLowerCase());

                var cityMatch = selectedCity === '' || cityCell === selectedCity;
                var searchMatch = searchString === '' || searchCells.some(cell => cell.includes(searchString));

                row.style.display = cityMatch && searchMatch ? '' : 'none';
            });
        }
    </script>
@endsection
