<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Governance Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/adduser.css') }}">
</head>
<body>
<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h1 class="gov-title">Admin Portal</h1>
        <nav>
            <ul class="sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a></li>
                <li><a href="{{ route('dashboard.all_tickets') }}">📋 All Tickets</a></li>
                <li><a href="{{ route('dashboard.open_tickets') }}">🟢 Open</a></li>
                <li><a href="{{ route('dashboard.closed_tickets') }}">🔴 Closed</a></li>
                {{-- <li><a href="{{ route('dashboard.priority_tickets') }}">⚠️ Priority</a></li> --}}
                <li><a href="{{ route('dashboard.add_user') }}">👤 Add User</a></li>
          
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
       <header class="main-header">
    <img src="{{ asset('images/gov-logo.png') }}" alt="Gov Logo" class="gov-logo">
    <h1>Sevaportal Ticket System</h1>
    <p class="subtitle">Municipality Service Portal</p>
      <form method="POST" action="{{ route('admin.logout') }}" class="logout-form" style="position:absolute; top:115px; right:40px;">
        @csrf
        <button type="submit" style="padding: 6px 12px; background-color: #d9534f; color: white; border: none; border-radius: 5px;">Logout</button>
    </form>
</header>

     <div class="login-container">
    <h1>Add User</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('dashboard.store_user') }}">
        @csrf
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Add</button>
    </form>
</div>


        <footer class="main-footer">
            <p>&copy; 2025 SevaPortal | Powered by MadCoders</p>
        </footer>
    </div>
</div>


</body>
</html>
