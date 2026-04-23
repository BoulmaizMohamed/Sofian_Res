<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * POST /api/admin/login
     */
    public function login(AdminLoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('admins')->attempt($credentials);

        if (! $token) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful.',
            'token'   => $token,
            'type'    => 'bearer',
            'admin'   => Auth::guard('admins')->user(),
        ]);
    }

    /**
     * POST /api/admin/logout
     */
    public function logout(): JsonResponse
    {
        Auth::guard('admins')->logout();

        return response()->json(['message' => 'Logged out successfully.']);
    }

    /**
     * GET /api/admin/me
     */
    public function me(): JsonResponse
    {
        return response()->json(Auth::guard('admins')->user());
    }
}
