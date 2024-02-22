<!-- resources/views/promo_codes/bulk_create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bulk Create Promo Codes</h1>

        <form action="{{ route('promo_codes.storeBulk') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="promo_codes">Enter Promo Codes (one per line):</label>
                <textarea name="promo_codes" id="promo_codes" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Promo Codes</button>
                <a href="{{ route('promo_codes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <form action="{{ route('promo_codes.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button type="submit">Upload CSV</button>
    </form>
@endsection
