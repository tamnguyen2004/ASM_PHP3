<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanDeleteUser
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->route('user');
        if ($userId == Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }
        return $next($request);
    }
}

