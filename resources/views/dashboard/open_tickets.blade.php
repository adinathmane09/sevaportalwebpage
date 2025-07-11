<!-- resources/views/admin/open_tickets.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🟢 Open Tickets</title>
    <link rel="stylesheet" href="{{ asset('css/openTickets.css') }}">
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

        <div class="scrollable-section">

            <!-- Page Title & Stats -->
            <div class="open-tickets-header" style="padding: 20px;">
                <h2>🟢 Open Tickets</h2>
                <p>Showing all currently unresolved or pending tickets</p>
                <div class="stats-card">
                    <strong>Total Open Tickets:</strong> <span id="open-count">0</span>
                </div>
            </div>

            <!-- Table -->
            <main class="content">
                <section class="ticket-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Change Status</th>
                                <th>Media</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody id="ticketBody"></tbody>
                    </table>
                </section>
            </main>

        </div>

        <footer class="main-footer">
            <p>&copy; 2025 SevaPortal | Powered by MadCoders</p>
        </footer>
    </div>
</div>

<!-- JS Scripts -->
<script>
     const fetchRoute = "{{ route('open_tickets.fetch') }}";
    const updateRoute = "{{ route('open_tickets.update') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/openTickets.js') }}"></script>
</body>
</html>
