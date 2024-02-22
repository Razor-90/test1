@extends('layouts.admin')

@section('content')
    <h1>Bulk Create Promo Codes</h1>

    <form action="{{ route('promo_codes.storeBulkCSV') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="csv_file">CSV File:</label>
            <input type="file" name="csv_file" id="csv_file" required accept=".csv, .txt">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <form action="{{ route('promo_codes.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button type="submit">Upload CSV</button>
    </form>
@endsection
