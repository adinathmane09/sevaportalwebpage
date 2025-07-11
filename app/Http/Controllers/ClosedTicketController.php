<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ClosedTicketController extends Controller
{
    // Show Closed Tickets Page
    public function index()
    {
        return view('dashboard.closed_tickets');
    }

    // Fetch only Closed Tickets via AJAX
    public function fetch()
    {
        $closedTickets = Ticket::where('status', 'closed')->get();
        return response()->json($closedTickets);
    }
}
