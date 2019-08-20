<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->load('roles', 'permissions');
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->error('error.not-found');
        }

        return $user->load('roles', 'permissions');
    }
}
