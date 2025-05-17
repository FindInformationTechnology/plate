<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use App\Models\User;
use App\Models\Emirate;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plates = Plate::with(['user', 'emirate', 'code'])->latest()->get();
        $users = User::all();
        $emirates = Emirate::all();
        $codes = Code::all();
        
        return view('admin.pages.plates.index', compact('plates', 'users', 'emirates', 'codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $users = User::where('role', 'user')->get();
        $users = User::get();
        $emirates = Emirate::all();
        $codes = Code::all();
        
        return view('admin.pages.plates.create', compact('users', 'emirates', 'codes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'emirate_id' => 'required|exists:emirates,id',
            'code_id' => 'required|exists:codes,id',
            'number' => 'required|string|max:255',
            'length' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
           
            // 'is_sold' => 'boolean',
            // 'is_visible' => 'boolean',
        ]);

        $data = $request->all();

        // dd($data);
        
        // Set default values for checkboxes if not provided
        $data['is_approved'] = $request->has('is_approved') ? 1 : 0;
        // $data['is_sold'] = $request->has('is_sold') ? 1 : 0;
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        
        Plate::create($data);

        return redirect()->route('admin.plates.index')->with('success', 'Plate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plate = Plate::with(['user', 'emirate', 'code'])->findOrFail($id);
        
        return view('admin.pages.plates.show', compact('plate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plate = Plate::findOrFail($id);
        $users = User::get();
        $emirates = Emirate::all();
        $codes = Code::all();
        
        return view('admin.pages.plates.edit', compact('plate', 'users', 'emirates', 'codes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'emirate_id' => 'required|exists:emirates,id',
            'code' => 'required|exists:codes,id',
            'number' => 'required|string|max:255',
            'length' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            
        ]);

        $plate = Plate::findOrFail($id);
        
        $data = $request->all();
        
        // Set default values for checkboxes if not provided
      
        
        $plate->update($data);

        return redirect()->route('admin.plates.index')->with('success', 'Plate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $plate = Plate::findOrFail($request->id);
        $plate->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Update the status of a plate.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:plates,id',
            'status' => 'required|boolean',
        ]);

        $plate = Plate::findOrFail($request->id);
        $plate->update(['is_approved' => $request->status]);

        return response()->json(['success' => true]);
    }

    /**
     * Update the sold status of a plate.
     */
    public function updateSold(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:plates,id',
            'status' => 'required|boolean',
        ]);

        $plate = Plate::findOrFail($request->id);
        $plate->update([
            'is_sold' => $request->status,
            'is_visible' => $request->status ? 0 : 1, // If sold, not available
        ]);

        return response()->json(['success' => true]);
    }
}

