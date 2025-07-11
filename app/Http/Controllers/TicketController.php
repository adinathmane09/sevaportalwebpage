<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $latestTickets = Ticket::latest()->take(10)->get();
            return view('admin.dashboard', compact('latestTickets'));
    }

    public function fetch()
    {
        return response()->json(Ticket::all());
    }

    public function update(Request $request)
{
    $ticket = Ticket::find($request->id);

    if ($ticket) {
        $ticket->update([
            'name' => $request->name,
            'subject' => $request->subject,
            'status' => $request->status,
            'raised_by' => $request->raised_by,
            'priority' => $request->priority,
        ]);
        return response()->json(['message' => 'Ticket updated']);
    }

    return response()->json(['message' => 'Ticket not found'], 404);
}


    public function delete(Request $request)
    {
        $ticket = Ticket::find($request->id);
        if ($ticket) {
            $ticket->delete();
            return response()->json(['message' => 'Deleted']);
        }
        return response()->json(['message' => 'Ticket not found'], 404);
    }
}
