<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

// use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showDashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin/login')->withErrors(['login' => 'Please log in to access the dashboard.']);
            }
        return view('admin.dashboard');
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
       if ($admin && Hash::check($request->password, $admin->password)) {
        // You can also set a session here if you want to track login
        session(['admin_logged_in' => true, 'admin_username' => $admin->username]);
        return redirect('/dashboard')->with('success', 'Welcome, Admin!');
    }
    return back()->withErrors(['login' => 'Wrong username or password. Try again!'])->withInput();
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



public function storeUser(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:admins,username',
        'password' => 'required|string|min:6',
    ]);

    Admin::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('dashboard.add_user')->with('success', 'User added successfully!');
}

}
