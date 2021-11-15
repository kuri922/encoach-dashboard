@extends('layouts.dashboard')

@section('content')
<div class="w-75">

    <h1>管理者一覧</h1>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col" class="w-25">ID</th>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <th scope="row">{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $admins->links() }}
</div>
@endsection