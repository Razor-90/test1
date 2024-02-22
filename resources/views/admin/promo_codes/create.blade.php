<!-- resources/views/promo_codes/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>+ Promo Code</h1>

        <form action="{{ route('admin.promo_codes.store') }}" method="POST">
            @csrf
            <label for="promo_code">Enter Promo Code:</label>
            <input type="text" name="promo_code" id="promo_code">
            <button type="submit">Add Promo Code</button>
        </form>
    </div>
@endsection
ц
