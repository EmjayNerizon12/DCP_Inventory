<?php

namespace App\Http\Controllers;

use App\Models\SchoolUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SchoolAccountController extends Controller
{
    public function index()
    {
        return view('SchoolSide.Account.index');
    }

    public function showAccounts()
    {
        $list = SchoolUser::with('school')->get();
        return response()->json(['success' => true, 'data' => $list]);
    }
    public function change_password(Request $request)
    {
        $request->validate([

            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::guard('school')->user()->school->schoolUser;
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        } else if ($request->current_password === $request->new_password) {
            return back()->withErrors(['new_password' => 'New password cannot be the same as the current password.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->password_changed_at = now();
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
    public function reset_password(Request $request)
    {

        $request->validate([
            'id' => 'required',

        ]);

        $school_user = SchoolUser::find($request->id);

        if (!$school_user) {
            return back()->withErrors(['id' => 'User not found.']);
        }

        $school_user->update([
            'password' => Hash::make($school_user->default_password),
            'password_changed_at' => now(),
        ]);

        return back()->with('success', 'Password reset successfully.');
    }
}
