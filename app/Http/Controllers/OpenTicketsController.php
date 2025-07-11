<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class OpenTicketsController extends Controller
{
   public function index()
    {
        return view('dashboard.open_tickets');
    }

    public function fetch()
    {
        // Return all tickets where status != 'closed'
        $tickets = Ticket::where('status', '!=', 'closed')->get();
        return response()->json($tickets);
    }

    public function update(Request $request)
{
    $ticket = Ticket::find($request->id);

    if ($ticket) {
        $ticket->update([
            'status' => $request->status
        ]);
        return response()->json(['message' => 'Status updated']);
    }

    return response()->json(['message' => 'Ticket not found'], 404);
}


}
