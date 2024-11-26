<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'quantity' => 'nullable|integer|min:0', // Xác thực quantity
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/products', 'public');
    }

    Product::create([
        'name' => $validatedData['name'],
        'price' => $validatedData['price'],
        'category_id' => $validatedData['category_id'],
        'image' => $imagePath,
        'quantity' => $validatedData['quantity'] ?? 0, // Đặt giá trị mặc định là 0 nếu không có
    ]);

    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
}




public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

public function update(Request $request, Product $product)
{
    // Xác thực dữ liệu
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Xử lý ảnh mới nếu có
    $imagePath = $product->image; // Giữ ảnh cũ nếu không có ảnh mới

    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu tồn tại
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Lưu ảnh mới và lấy đường dẫn
        $imagePath = $request->file('image')->store('images/products', 'public');
    }

    // Cập nhật thông tin sản phẩm
    $product->update([
        'name' => $validatedData['name'],
        'price' => $validatedData['price'],
        'quantity' => $validatedData['quantity'],
        'category_id' => $validatedData['category_id'],
        'image' => $imagePath,
    ]);

    // Điều hướng về trang danh sách sản phẩm với thông báo thành công
    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
}


    



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
