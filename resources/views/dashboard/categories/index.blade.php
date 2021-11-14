@extends('layouts.dashboard')

@section('content')
<div class="w-75">
    <form method="POST" action="/dashboard/categories">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="category-name">カテゴリ名</label>
            <input type="text" name="name" id="category-name" class="form-control @error('name') is-invalid @enderror ">
            @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>入力されていません。</strong>
                    </span>
                    @enderror
        </div>
        <div class="form-group">
            <label for="category-description">カテゴリの説明</label>
            <textarea name="description" id="category-description" class="form-control @error('description') is-invalid @enderror "></textarea>
            @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>入力されていません。</strong>
                    </span>
                    @enderror
        </div>
        <div class="form-group">
            <label for="category-major-category-name">親カテゴリ名</label>
            <input type="text" name="major_category_name" id="category-major-category-name" class="form-control @error('major_category_name') is-invalid @enderror">
            @error('major_category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>入力されていません。</strong>
                    </span>
                    @enderror
        </div>
        <button type="submit" class="btn samazon-submit-button">＋新規作成</button>
    </form>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col" class="w-25">ID</th>
                <th scope="col">カテゴリ</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="/dashboard/categories/{{ $category->id }}/edit" class="dashboard-edit-link">編集</a>
                </td>
                <td>
                    <a href="/dashboard/categories/{{ $category->id }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dashboard-delete-link">
                        削除
                    </a>

                    <form id="logout-form" action="/dashboard/categories/{{ $category->id }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection 