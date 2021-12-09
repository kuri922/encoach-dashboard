@extends('layouts.dashboard')

@section('content')
<h1>商品管理</h1>


<div class="w-100 mt-5 my-5">
    <div class="d-flex align-items-center">
        <a href="/dashboard/products/create" class="btn 
                encoach-submit-button">+ 新規作成</a>
    </div>
    <div class="table-responsive">
        <table class="table fixed-table mt-2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th >画像</th>
                    <th scope="col">商品</th>
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
                    <th cscope="row" class="ps-5">{{ $product->id }}</td>
                    <td>
                        <!-- 画像表示 -->
                        @if($product -> image !== "") 
                            <img src="{{$product['image']?? '' }}" class="w-50 img-fluid">
                        @else
                            <img src="{{ asset('img/dummy.jpg')}}" class="w-50 img-fuild">
                        @endif
                    </td>
                    <td class="px-5">{{ $product->name }}</td>
                    <td class="p-5">{{ $product->price }}</td>
                    <td class="p-5">{{ $product->category["name"]  }}</td>
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