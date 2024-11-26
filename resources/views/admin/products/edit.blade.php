@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cập nhật sản phẩm</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Giá sản phẩm</label>
            <input type="number" class="form-control" id="price" name="price" 
                   value="{{ old('price', $product->price) }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng</label>
            <input type="number" class="form-control" id="quantity" name="quantity" 
                   value="{{ old('quantity', $product->quantity) }}" min="0" required>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục sản phẩm</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Ảnh sản phẩm</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label>Ảnh hiện tại</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                </div>
            @else
                <p>Không có ảnh hiện tại.</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
