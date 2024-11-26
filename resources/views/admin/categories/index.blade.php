@extends('layouts.app')

@section('content')
    <h1>Danh sách danh mục</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm Danh mục</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
