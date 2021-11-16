@extends('layouts.dashboard')

@section('content')
<h1>商品管理</h1>


<div class="w-100 mt-5">
    <div class="w-100">
        <form method="GET" action="{{ route('dashboard.products.index') }}">
            <div class="flex-inline form-group">
                <div class="d-flex align-items-center">
                  
    

        <a href="{{ route('dashboard.products.create') }}" class="btn encoach-submit-button">+ 新規作成</a>
    </div>
    <div class="table-responsive">
        <table class="table fixed-table mt-2">

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">画像</th>
                    <th scope="col">商品名</th>
                    <th scope="col">価格</th>
                    <th scope="col">カテゴリ名</th>
                    <th scope="col">親カテゴリ名</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row" class="ps-0">{{ $product->id }}</td>
                    <td>
                        @if($product -> image !== "")
                        <img src="{{ asset('storage/products/'.$product ->image) }}" class ="w-80 img-fluid">
                        @else
                        <img src="{{ asset('img/dummy.jpg')}}" class="w-80 img-fuild">
                        @endif
                    </td>

                    <td class="p-5">{{ $product->name }}</td>
                    <td class="p-5">{{ $product->price }}</td>
                    <td class="p-5">{{ $product->category["name"] }}</td>
                    <td class="p-5">{{ $product->category["major_category_name"] }}</td>
                    <td>
                        <a href="/dashboard/products/{{ $product->id }}/edit" class="dashboard-edit-link">編集</a>
                    </td>
                    <td>
                        <a href="/dashboard/products/{{ $product->id }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dashboard-delete-link">
                            削除
                        </a>

                        <form id="logout-form" action="/dashboard/products/{{ $product->id }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $products->links() }}
</div>
@endsection