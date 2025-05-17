<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emirate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmirateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emirates = Emirate::all();
        return view('admin.pages.emirates.index', compact('emirates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name['en'], // Default name for non-translated fields
        ];

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('emirates', 'public');
            $data['image'] = $iconPath;
        }

        $data['slug'] = $request->name['en']; // Default slug for non-translated fields

        $emirate = Emirate::create($data);
        
        // Save translations
        $emirate->setTranslations('name', $request->name);
        $emirate->save();

        return redirect()->route('admin.emirates.index')->with('success', 'Emirate created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emirate = Emirate::findOrFail($id);
        
        return response()->json([
            'emirate' => $emirate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $emirate = Emirate::findOrFail($id);
        
        $data = [
            'name' => $request->name['en'], // Default name for non-translated fields
        ];

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($emirate->image) {
                Storage::disk('public')->delete($emirate->image);
            }
            
            $iconPath = $request->file('icon')->store('emirates', 'public');
            $data['image'] = $iconPath;
        }
        
        // Handle icon removal
        if ($request->has('icon_remove') && $request->icon_remove == '1') {
            if ($emirate->image) {
                Storage::disk('public')->delete($emirate->image);
            }
            $data['image'] = null;
        }

       // Default name for non-translated fields]

        $emirate->update($data);
        
        // Save translations
        $emirate->setTranslations('name', $request->name);
        $emirate->save();

        return redirect()->route('admin.emirates.index')->with('success', 'Emirate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $emirate = Emirate::findOrFail($id);
        
        // Check if emirate has related codes
        if ($emirate->codes()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete emirate with associated codes'
            ], 422);
        }
        
        // Delete icon if exists
        if ($emirate->image) {
            Storage::disk('public')->delete($emirate->image);
        }
        
        $emirate->delete();

        return response()->json(['success' => true]);
    }
}