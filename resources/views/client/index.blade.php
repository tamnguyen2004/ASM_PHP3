<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 1050px; }
        .menu { margin-bottom: 35px; }
        .product img { max-width: 100%; height: auto; }
        .card { height: 100%; } /* Đảm bảo thẻ card có chiều cao 100% */
        .card-body { display: flex; flex-direction: column; justify-content: space-between; } /* Giúp căn giữa nội dung */
        .carousel { max-width: 650px; margin: auto; } /* Đặt chiều rộng tối đa cho carousel và căn giữa */
        .carousel-inner img { max-height: 320px; width: 100%; object-fit: cover; } /* Đặt chiều cao tối đa cho ảnh */
        a { text-decoration: none;} /* Xóa gạch chân dưới các thẻ a */
    </style>
    
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('client.home') }}">Phone Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('client.home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    </ul>
                    <!-- User Avatar and Name -->
                    @if(auth()->check())
                    <div class="ms-3 d-flex align-items-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                        @endif
                        <span class="navbar-text text-white">
                            {{ auth()->user()->fullname }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </nav>
        <div class="row">
            <!-- Cột bên trái chứa danh mục -->
            <div class="col-md-2">
                <div class="menu">
                    <h2>Categories</h2>
                    @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->id) }}" class="badge bg-primary text-white me-2 d-block mb-2">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Cột giữa chứa slideshow -->
            <div class="col-md-8">
                <div id="productCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Slide 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Cột bên phải chứa sản phẩm sale -->
            <div class="col-md-2">
                <h2>Sale</h2>
                {{-- @foreach ($saleProducts as $saleProduct) <!-- Giả sử bạn có một biến $saleProducts chứa sản phẩm sale -->
                    <div class="card mb-2">
                        <img src="{{ asset($saleProduct->image) }}" class="card-img-top" alt="{{ $saleProduct->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $saleProduct->name }}</h5>
                            <p class="card-text">Price: ${{ $saleProduct->price }}</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="row">
            <h2>Sản phẩm mới</h2>
            @if ($products->count())
                @foreach ($products as $product)
                    <div class="col-md-4 col-lg-3 mb-4"> <!-- Hiển thị 4 sản phẩm mỗi hàng -->
                        <div class="card">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Price: ${{ $product->price }}</p>
                                <p class="card-text">Quantity: {{ $product->quantity }}</p>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No products found.</p>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
