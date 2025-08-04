<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Governance Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/allTicket.css') }}">
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

        <!-- Content Section -->
        <main class="content">
            <section class="ticket-table">
                <h2 style="margin-bottom: 20px;">All Complaints</h2>

                @if(session('success'))
                    <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
                @endif

                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Subject</th>
                                <th>Ward</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->id }}</td>
                                    <td>{{ $complaint->username }}</td>
                                    <td>{{ $complaint->subject }}</td>
                                    <td>{{ $complaint->ward }}</td>
                                    <td>
                                    <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}" target="_blank">
                                            View Location 📍
                                    </a>
                                    </td>
                                    <td>
                                        @if($complaint->is_raised)
                                            <button disabled style="padding: 4px 8px; background-color: gray; color: white; border: none; border-radius: 5px;">Raised</button>
                                        @else
                                            <a href="{{ route('dashboard.raise_ticket', $complaint->id) }}"
                                            class="btn btn-warning"
                                            style="padding: 4px 8px; background-color: orange; color: white; text-decoration: none; border-radius: 5px;">
                                            Raise Ticket
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="main-footer">
            <p>&copy; 2025 SevaPortal | Powered by MadCoders</p>
        </footer>
    </div>
</div>

<script>
    function toggleDetails(id) {
        const el = document.getElementById("details-" + id);
        el.style.display = el.style.display === "none" ? "block" : "none";
    }
    
</script>

</body>
</html>
