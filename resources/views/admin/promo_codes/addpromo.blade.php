<!-- resources/views/promo_codes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Промокоды</h1>

    <!-- Форма для загрузки CSV файла -->
    <form action="{{ route('promo_codes.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button type="submit">Загрузить промокоды</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Остальная часть представления для отображения промокодов -->
    <table>
        <!-- ... -->
    </table>
@endsection
