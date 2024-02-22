@extends('layouts.admin')

@section('content')
    <h1>Юзеры</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Email</th>
            <th>Email</th>
            <th>Город</th>
            <th>Админ</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->city }}</td>
                <td>{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
