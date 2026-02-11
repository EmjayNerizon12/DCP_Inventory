<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolUser;
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
            'fromAdmin' => 'nullable'
        ]);

        if ($request->fromAdmin) {
            session()->flush();
            $users = SchoolUser::where('username', $request->username)->first();
            // dd($request->password);
            session(['UserRole' => 'School']);

            if ($users && $request->password == $users->default_password) {
                Auth::guard('school')->login($users, $request->has('remember'));
                $users->last_login = now();
                $users->save();
                return redirect()->intended('School/dashboard');
            }
        }
        if ($request->username == "admin") {
            $password = SchoolUser::where('username', 'admin')->value('password');
            if (!Hash::check($request->password, $password)) {
                return back()->withErrors(['login' => 'Invalid credentials']);
            }
            session(['UserRole' => 'Admin']);
            session(['admin_logged_in' => true]);
            return response()->json([
                'success' => true,
                'message' => 'Login Successful',
                'redirect_url' => route('AdminSide-Dashboard')
            ]);
        } else {
            $users = SchoolUser::where('username', $request->username)->first();
            // dd($request->password);
            session(['UserRole' => 'School']);


            if (Hash::check($request->password, $users->password)) {
                Auth::guard('school')->login($users, $request->has('remember'));
                $users->last_login = now();
                $users->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful',
                    'redirect_url' => url('School/dashboard')
                ]);
            }
        }
        return response()->json(['login' => 'Invalid credentials']);
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
}
