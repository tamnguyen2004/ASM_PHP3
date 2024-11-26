<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ClientController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('client.index', compact('products', 'categories'));
    }
    public function show($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);
        return view('client.product_detail', compact('product'));
    }
    public function category($id)
    {
        $category = Category::findOrFail($id);
        
        $products = Product::where('category_id', $id)->get();
        
        return view('client.category', compact('products', 'category'));
    }
}
