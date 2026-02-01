<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'fromAdmin' => 'nullable', // optional for web login
            'remember' => 'nullable|boolean' // optional remember me
        ]);

        // Find user by username
        $user = SchoolUser::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 200);
        }

        // -------------------------------
        // 1️⃣ Web login (session) if fromAdmin
        // -------------------------------
        if (!empty($validated['fromAdmin'])) {
            session()->flush();
            session(['UserRole' => 'School']);

            if ($validated['password'] == $user->default_password) {
                $user->last_login = now();
                $user->save();
            }
        } else {
            // -------------------------------
            // 2️⃣ Admin session login
            // -------------------------------
            if ($user->username === 'admin') {
                session(['UserRole' => 'Admin']);
                session(['admin_logged_in' => true]);
            } else {
                session(['UserRole' => 'School']);
                if (Hash::check($validated['password'], $user->password)) {
                    $user->last_login = now();
                    $user->save();
                }
            }
        }

        // -------------------------------
        // 3️⃣ Generate Sanctum token
        // -------------------------------
        // Optional: you can include a device name like "mobile" or "web"
        $token = $user->createToken('api-token')->plainTextToken;

        // Determine role and redirect URL
        $role = $user->username === 'admin' ? 'Admin' : 'School';
        $url = $role === 'Admin' ? route('AdminSide-Dashboard') : url('School/dashboard');

        // -------------------------------
        // 4️⃣ Return JSON response
        // -------------------------------
        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            'role' => $role,
            'redirect_url' => $url
        ]);
    }
}
