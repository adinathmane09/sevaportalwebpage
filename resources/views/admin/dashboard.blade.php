<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sevaportal Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashstyles.css') }}">
</head>
<body>
<div class="dashboard-container">

                        
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

    <section class="summary-cards">
         <div class="card blue">
            <h3>Total Complaints</h3>
            <p id="totalCount">0</p>
        </div>
     <div class="card green">
            <h3>Opend</h3>
            <p id="openCount">0</p>
    </div>
        <div class="card red">
             <h3>Closed</h3>
             <p id="closedCount">0</p>
        </div>
     <div class="card yellow">
              <h3>Priority</h3>
             <p id="priorityCount">0</p>
    </div>

    </section>

       
        <main class="content">
            <section class="ticket-table">
                <table>
                    <thead>
                        <tr>
                        <th>Ticket ID</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Raised By</th>
                        <th>Priority</th>
                            @if(Route::currentRouteName() === 'dashboard.all_tickets')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="ticketBody">
                        <!-- Data JavaScript-->
                    </tbody>
                </table>
            </section>
        </main>
</div>
        <footer class="main-footer">
            <p>&copy; 2025 SevaPortal | Powered by MadCoders</p>
        </footer>
</div>
</div>

<script>
    const fetchRoute = "{{ route('tickets.fetch') }}";
    const updateRoute = "{{ route('tickets.update') }}";
    const deleteRoute = "{{ route('tickets.delete') }}";
    const csrfToken = "{{ csrf_token() }}";
    const isAllTicketsPage = "{{ Route::currentRouteName() === 'dashboard.all_tickets' ? 'true' : 'false' }}";
</script>
<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
