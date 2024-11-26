<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin-top: 20px; }
        .product-image { max-width: 400px; height: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">{{ $product->name }}</h1>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image mb-4">
        
        <h5>Price: ${{ $product->price }}</h5>
        <h5>Quantity: {{ $product->quantity }}</h5>
        <p>{{ $product->description ?? 'No description available.' }}</p>

        <a href="{{ route('client.home') }}" class="btn btn-primary">Back to Products</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
