<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Emirate;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function index()
    {
        $codes = Code::with('emirate')->get();
        $emirates = Emirate::all();
        return view('admin.pages.codes.index', compact('codes', 'emirates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'emirate_id' => 'required|exists:emirates,id',
        ]);

        Code::create([
            'name' => $request->name,
            'emirate_id' => $request->emirate_id,
        ]);

        return redirect()->route('admin.codes.index')->with('success', 'Code created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $code = Code::findOrFail($id);
        
        return response()->json([
            'code' => $code,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'emirate_id' => 'required|exists:emirates,id',
        ]);

        $code = Code::findOrFail($id);
        $code->update([
            'name' => $request->name,
            'emirate_id' => $request->emirate_id,
        ]);

        return redirect()->route('admin.codes.index')->with('success', 'Code updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $code = Code::findOrFail($id);
        $code->delete();

        return response()->json(['success' => true]);
    }
}
