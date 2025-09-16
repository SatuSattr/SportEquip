<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Models\SportsEquipment;

class BorrowController extends Controller
{
    // Admin: Display all borrow requests
    public function index()
    {
        $borrowRequests = BorrowRequest::all();
        return view('admin.borrow.index', compact('borrowRequests'));
    }

    // User: Show borrow form
    public function create()
    {
        $equipment = SportsEquipment::where('item_status', 'available')->get();
        return view('user.borrow', compact('equipment'));
    }

    // User: Store borrow request
    public function store(Request $request)
    {
        $request->validate([
            'borrower_name' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        BorrowRequest::create($request->all());

        return redirect()->route('borrow.create')->with('success', 'Borrow request submitted successfully.');
    }

    // Admin: Approve borrow request
    public function approve($id)
    {
        $borrowRequest = BorrowRequest::findOrFail($id);
        $borrowRequest->status = 'approved';
        $borrowRequest->save();

        return redirect()->route('admin.borrow.requests')->with('success', 'Borrow request approved.');
    }

    // Admin: Decline borrow request
    public function decline($id)
    {
        $borrowRequest = BorrowRequest::findOrFail($id);
        $borrowRequest->status = 'declined';
        $borrowRequest->save();

        return redirect()->route('admin.borrow.requests')->with('success', 'Borrow request declined.');
    }
}
