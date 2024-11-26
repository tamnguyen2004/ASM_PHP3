<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|string|max:255|unique:users,username',
        'role' => 'required|in:admin,user',
        'password' => 'required|string|min:5',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Xử lý upload avatar
    $avatarPath = null;
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    }

    User::create([
        'fullname' => $validatedData['fullname'],
        'email' => $validatedData['email'],
        'username' => $validatedData['username'],
        'role' => $validatedData['role'],
        'password' => Hash::make($validatedData['password']),
        'avatar' => $avatarPath, // Lưu đường dẫn avatar vào cơ sở dữ liệu
    ]);

    return redirect()->route('users.index')->with('success', 'Người dùng đã được tạo thành công.');
}

public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,user',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Xử lý upload avatar
    if ($request->hasFile('avatar')) {
        // Xóa ảnh cũ nếu có
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $validatedData['avatar'] = $avatarPath; // Cập nhật đường dẫn avatar
    }

    $user->update($validatedData);

    return redirect()->route('users.index')->with('success', 'Người dùng đã được cập nhật thành công.');
}


    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Bạn không thể xóa chính mình.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
