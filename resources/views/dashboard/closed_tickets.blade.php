<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔴 Closed Tickets</title>
    <link rel="stylesheet" href="{{ asset('css/closeTickets.css') }}">
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
                <li><a href="{{ route('dashboard.Managetickets') }}">⚠️ Raise Tickets</a></li>
                <li><a href="{{ route('dashboard.add_user') }}">👤 Add User</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="main-header">
            <img src="{{ asset('images/gov-logo.png') }}" alt="Gov Logo" class="gov-logo">
            <h1>Sevaportal Complaint System</h1>
            <p class="subtitle">Municipality Service Portal</p>
            <form method="POST" action="{{ route('admin.logout') }}" class="logout-form" style="position:absolute; top:115px; right:40px;">
                @csrf
                <button type="submit" style="padding: 6px 12px; background-color: #d9534f; color: white; border: none; border-radius: 5px;">Logout</button>
            </form>
        </header>

        <div class="scrollable-section">

            <!-- Page Title & Stats -->
            <div class="open-tickets-header" style="padding: 20px;">
                <h2>🔴 Closed Tickets</h2>
                <div class="stats-card">
                    <strong>Total Closed Tickets:</strong> <span id="closed-count">0</span>
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
                                <th>Closed At</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody id="closedTicketBody"></tbody>
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
    const fetchRoute = "{{ route('closed_tickets.fetch') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/closeTickets.js') }}"></script>
</body>
</html>
