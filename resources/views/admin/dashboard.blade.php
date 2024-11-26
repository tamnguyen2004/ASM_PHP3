<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Danh sách Danh mục</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Danh sách Sản phẩm</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Danh sách Người dùng</a>
                        </li>
                        
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary nav-link" style="color: white">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                    <!-- User Avatar and Name -->
                    <div class="ms-auto d-flex align-items-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                        @endif
                        <span class="navbar-text">
                            {{ auth()->user()->fullname }}
                        </span>
                    </div>
                </div>
            </div>
        </nav>

        <h1 class="my-4">Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Products</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalProducts }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Views</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalViews }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalUsers }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Products by Category</h3>
        <ul class="list-group">
            @foreach ($productsByCategory as $category)
                <li class="list-group-item">
                    {{ $category->category->name }} - Total Products: {{ $category->total }}
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
