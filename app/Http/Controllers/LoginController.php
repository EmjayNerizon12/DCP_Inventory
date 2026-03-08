<?php

namespace App\Http\Controllers;

use App\Models\SchoolUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // your Blade view
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'fromAdmin' => 'nullable|boolean',
        ]);

        $user = SchoolUser::where('username', $request->username)->first();
        if (! $user) {
            return response()->json(['login' => 'Invalid credentials'], 401);
        }

        // Admin bypass: admin can log in as school using the target account's default password.
        if ($request->boolean('fromAdmin')) {
            if ($this->isAdmin($user)) {
                return response()->json(['login' => 'Invalid credentials'], 401);
            }

            if (! $this->matchesDefaultPassword($request->password, $user->default_password)) {
                return response()->json(['login' => 'Invalid credentials'], 401);
            }

            session()->flush();
            session([
                'UserRole' => 'School',
                'from_admin_bypass' => true,
            ]);

            Auth::guard('school')->login($user, $request->boolean('remember'));
            $user->last_login = now();
            $user->save();

            return redirect()->intended('School/dashboard');
        }

        if ($this->isAdmin($user)) {
            if (! Hash::check($request->password, $user->password)) {
                return response()->json(['login' => 'Invalid credentials'], 401);
            }

            session([
                'UserRole' => 'Admin',
                'admin_logged_in' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Successful',
                'redirect_url' => route('admin.dashboard'),
            ]);
        }

        if (! Hash::check($request->password, $user->password)) {
            return response()->json(['login' => 'Invalid credentials'], 401);
        }

        session(['UserRole' => 'School']);

        Auth::guard('school')->login($user, $request->boolean('remember'));
        $user->last_login = now();
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'redirect_url' => url('School/dashboard'),
        ]);
    }

    public function logout()
    {
        if (session()->has('admin_logged_in')) {
            session()->forget('admin_logged_in');

            return redirect()->route('login');
        }
        Auth::guard('school')->logout();

        return redirect()->route('login');
    }

    private function isAdmin(SchoolUser $user): bool
    {
        return is_null($user->pk_school_id);
    }

    private function matchesDefaultPassword(string $inputPassword, ?string $storedDefaultPassword): bool
    {
        if (empty($storedDefaultPassword)) {
            return false;
        }

        // Supports plain stored defaults and hashed values.
        if ($inputPassword === $storedDefaultPassword) {
            return true;
        }

        return Hash::check($inputPassword, $storedDefaultPassword);
    }
}
