<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;
use Str;

class TestController extends Controller
{
    public function index()
    {
        $plates = Plate::all();
        return view('admin.pages.plates.index', compact('plates'));
    }
    public function create()
    {
        return view('admin.plate.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = $this->generateSlug($data['name']);
        $plate = Plate::create($data);
        return redirect()->route('admin.plate.show', $plate->slug);
    }

    public function show($slug)
    {
        $plate = Plate::where('slug', $slug)->first();
        if ($plate) {
            return view('admin.plate.show', compact('plate'));
        } else {
            abort(404);
        }
    }

    public function edit($slug)
    {
        $plate = Plate::where('slug', $slug)->first();
        if ($plate) {
            return view('admin.plate.edit', compact('plate'));
        } else {
            abort(404);
        }
    }
    public function update(Request $request, $slug)
    {
        $data = $request->all();
        $plate = Plate::where('slug', $slug)->first();
        if ($plate) {
            $data['slug'] = $this->generateSlug($data['name']);
            $plate->update($data);
            return redirect()->route('admin.plate.show', $plate->slug);
        } else {
            abort(404);
        }
    }

    public function destroy(Request $request)
    {
        try {
            
            $request->validate([
                'id' => 'required|exists:plates,id'
            ]);
            
            $plate = Plate::findOrFail($request->id);
            $plate->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Plate deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    private function generateSlug($string)
    {
        $slug = \Illuminate\Support\Str::slug($string, '-');
        $original_slug = $slug;
        $c = 1;
        while (Plate::where('slug', $slug)->first()) {
            $slug = $original_slug . '-' . $c;
            $c++;
        }
        return $slug;
    }

    public function updateStatus(Request $request)
    {
        try {
            
            $request->validate([
                'id' => 'required|exists:plates,id',
                'status' => 'required|boolean'
            ]);
            
            $plate = Plate::findOrFail($request->id);
            $plate->is_approved = $request->status;
            $plate->save();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updateSold(Request $request)
    {
        try {
            
            $request->validate([
                'id' => 'required|exists:plates,id',
                'is_sold' => 'required|boolean'
            ]);
            
            $plate = Plate::findOrFail($request->id);
            $plate->is_sold = $request->is_sold;
            $plate->save();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
