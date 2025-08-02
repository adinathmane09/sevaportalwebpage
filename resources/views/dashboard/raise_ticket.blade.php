<!-- resources/views/dashboard/raise_ticket.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Raise Ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/raiseticket.css') }}">
</head>
<body>
    <div class="container">
        <h2>Raise Ticket for {{ $complaint->username }}</h2>
        <form method="POST" action="{{ route('dashboard.raise_ticket_store') }}">
            @csrf
            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">

            <label for="raised_by">Raised By:</label>
            <input type="text" name="raised_by" id="raised_by" required>

            <label for="priority">Priority:</label>
            <select name="priority" id="priority" required>
                <option value="">Select Priority</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>

            <button type="submit">Raise Ticket</button>
        </form>
        <a class="back-link" href="{{ route('dashboard.Managetickets') }}">← Back to Manage Tickets</a>
    </div>
</body>
</html>
