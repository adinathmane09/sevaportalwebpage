<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Complaint;



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
    public function manageTickets()
{
    $complaints = Complaint::all(); // Assuming these are from Flutter
    return view('dashboard.managetickets', compact('complaints'));
}

public function raiseTicket(Request $request)
{ $request->validate([
        'complaint_id' => 'required|exists:complaints,id',
        'raised_by' => 'required|string',
        'priority' => 'required|in:High,Medium,Low',
    ]);

    $complaint = Complaint::findOrFail($request->complaint_id);

    Ticket::create([
        'name' => $complaint->username,
        'subject' => $complaint->subject,
        'status' => 'Open',
        'raised_by' => $request->raised_by,
        'priority' => $request->priority,
        'description' => $complaint->description,
        'location' => "https://www.google.com/maps?q={$complaint->latitude},{$complaint->longitude}",
        'image' => $complaint->image_path,
    ]);

    // ✅ Update is_raised to 1
    $complaint->is_raised = 1;
    $complaint->save();

    return redirect()->route('dashboard.Managetickets')->with('success', 'Ticket raised successfully!');
}

public function show($id)
{
    $complaint = Complaint::findOrFail($id);
    return view('dashboard.raise_ticket', compact('complaint'));
}

}
