<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Hiển thị trang dashboard
    public function index()
    {
        // Đếm tổng số sản phẩm
        $totalProducts = Product::count();
        
        // Đếm tổng số người dùng
        $totalUsers = User::count();

        // Đếm tổng số lượt xem
        $totalViews = Product::sum('views');

        // Đếm số sản phẩm theo danh mục
        $productsByCategory = Product::select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->with('category') // Thêm dòng này để lấy tên danh mục
            ->get();

        // Truyền các biến vào view
        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'totalViews', 'productsByCategory'));
    }

    // Hiển thị danh sách người dùng
    public function indexUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo người dùng
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Lưu người dùng mới
    public function storeUser(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Hiển thị form chỉnh sửa người dùng
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update($request->only('fullname', 'username', 'email', 'role'));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Xóa người dùng
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // Kiểm tra không cho phép xóa chính mình
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

