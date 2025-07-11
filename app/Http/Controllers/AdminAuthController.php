<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showDashboard()
    {
        return view('admin.dashboard'); // Ensure the view file path is correct
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Fetch admin details from the database
        $admin = DB::table('admins')->where('username', $request->username)->first();

        // Compare the password directly (plain text comparison)
        if ($admin && $request->password === $admin->password) {
            return redirect('/dashboard')->with('success', 'Welcome, Admin!');
        }

        return back()->withErrors(['login' => 'Invalid username or password']);
    }

    public function showAllTickets()
    {
        return view('dashboard.all_tickets'); // All Tickets view
    }

    public function showOpenTickets()
    {
        return view('dashboard.open_tickets'); // Open Tickets view
    }

    public function showClosedTickets()
    {
        return view('dashboard.closed_tickets'); // Closed Tickets view
    }

    public function showPriorityTickets()
    {
        return view('dashboard.priority_tickets'); // Priority Tickets view
    }

    public function showAddUser()
    {
        return view('dashboard.add_user'); // Add User view
    }
    public function logout(Request $request)
    {
        $request->session()->invalidate();   // Destroys session
        $request->session()->regenerateToken(); // Prevent CSRF after logout
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

}
