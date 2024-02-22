<!-- resources/views/promo_codes/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Promo Code</h1>

        <form action="{{ route('promo_codes.update', $promoCodes->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" name="code" id="code" class="form-control" value="{{ $promoCodes->code }}" required>
            </div>

            <!-- Add other fields as needed -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Promo Code</button>
                <a href="{{ route('promo_codes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
