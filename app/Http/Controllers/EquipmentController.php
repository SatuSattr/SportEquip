<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportsEquipment;

class EquipmentController extends Controller
{
    // Admin: Display all equipment
    public function index()
    {
        $equipment = SportsEquipment::all();
        return view('admin.equipment.index', compact('equipment'));
    }

    // Admin: Show form to create new equipment
    public function create()
    {
        return view('admin.equipment.create');
    }

    // Admin: Store new equipment
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_status' => 'required|string|max:255',
            'item_quantity' => 'required|integer|min:0',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $equipment = new SportsEquipment($request->all());

        if ($request->hasFile('item_image')) {
            $imageName = time() . '.' . $request->item_image->extension();
            $request->item_image->move(public_path('images'), $imageName);
            $equipment->item_image = $imageName;
        }

        $equipment->save();

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment created successfully.');
    }

    // Admin: Show form to edit equipment
    public function edit($id)
    {
        $equipment = SportsEquipment::findOrFail($id);
        return view('admin.equipment.edit', compact('equipment'));
    }

    // Admin: Update equipment
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_status' => 'required|string|max:255',
            'item_quantity' => 'required|integer|min:0',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $equipment = SportsEquipment::findOrFail($id);
        $equipment->fill($request->except('item_image'));

        if ($request->hasFile('item_image')) {
            // Delete old image if exists
            if ($equipment->item_image && file_exists(public_path('images/' . $equipment->item_image))) {
                unlink(public_path('images/' . $equipment->item_image));
            }

            $imageName = time() . '.' . $request->item_image->extension();
            $request->item_image->move(public_path('images'), $imageName);
            $equipment->item_image = $imageName;
        }

        $equipment->save();

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment updated successfully.');
    }

    // Admin: Delete equipment
    public function destroy($id)
    {
        $equipment = SportsEquipment::findOrFail($id);

        // Delete image if exists
        if ($equipment->item_image && file_exists(public_path('images/' . $equipment->item_image))) {
            unlink(public_path('images/' . $equipment->item_image));
        }

        $equipment->delete();

        return redirect()->route('admin.equipment.index')->with('success', 'Equipment deleted successfully.');
    }

    // User: Display equipment in card format
    public function list(Request $request)
    {
        $query = SportsEquipment::where('item_status', 'available');
        
        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('item_name', 'LIKE', "%{$search}%");
        }
        
        // Paginate results
        $equipment = $query->paginate(6);
        
        return view('user.equipment', compact('equipment'));
    }
}
