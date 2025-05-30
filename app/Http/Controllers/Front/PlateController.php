<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlateRequest;
use App\Models\Code;
use App\Models\Plate;
use App\Services\PlateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Log\log;



class PlateController extends Controller
{
    public function index(PlateService $plate)
    {
        // return"test";
        return view("user.plate.index", ["plates" => $plate->getAllPlates()]);
    }

    public function create()
    {
        return view("user.plate.create");
    }

    public function store(StorePlateRequest $request, PlateService $plate)
    {

        try {
            // Validate the request data

            $validated = $request->validate([
                'emirate_id' => 'required|integer',
                'number' => 'required|string',
                'code_id' => 'required|string',
                'price' => 'nullable',
                // 'image' => 'nullable|image|max:8192',

            ]);

            if ($request->has('image')) {
                $path = $request->file('image')->store('plates', 'public');
                $validated['image'] = $path;
            }

            $plate = $plate->createPlate($validated);

            return redirect()->route("user.plates")->with("success", "The record has been added");
        } catch (\Exception $e) {
            log()->error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
            // return redirect()->route("user.plates")->with("error","Something went wrong");
        }
    }

    public function show($id)
    {
        $plates = Plate::where('is_visible', true)->get();
        $plate = Plate::findOrFail($id);
        return view("front.plate-details", ["plate" => $plate, 'plates' => $plates]);
    }

    public function edit($id, PlateService $plate)
    {

        $plate = Plate::findOrFail($id);

        // Check if the authenticated user owns this plate
        if (auth()->id() !== $plate->user_id) {
            return redirect()->route('user.plates')->with('error', 'You are not authorized to edit this plate.');
        }

        return view('user.plate.edit', compact('plate'));
    }
    public function update(Request $request, $id, PlateService $plate)
    {
        try {
            // Validate the request data
            $plate = Plate::findOrFail($id);

            // Check if the authenticated user owns this plate
            if (auth()->id() !== $plate->user_id) {
                return redirect()->route('user.plates')->with('error', 'You are not authorized to update this plate.');
            }

            // Validate the request
            $validated = $request->validate([
                'number' => 'required|string|max:255',
                'emirate_id' => 'required|exists:emirates,id',
                'code_id' => 'required|exists:codes,id',
                'price' => 'nullable',
                // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:8192',

                'remove_image' => 'nullable|boolean',
            ]);

            

            // Set boolean fields
            $validated['is_sold'] = $request->has('is_sold');
            $validated['is_visible'] = $request->has('is_visible');

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($plate->image && Storage::disk('public')->exists($plate->image)) {
                    Storage::disk('public')->delete($plate->image);
                }

                // Store new image
                $validated['image'] = $request->file('image')->store('plates', 'public');
            } elseif ($request->boolean('remove_image')) {
                // Remove image if requested
                if ($plate->image && Storage::disk('public')->exists($plate->image)) {
                    Storage::disk('public')->delete($plate->image);
                }
                $validated['image'] = null;
            } else {
                // Keep existing image
                unset($validated['image']);
            }

            // Remove fields that are not in the plates table
            unset($validated['remove_image']);

            // Update the plate
            $plate->update($validated);

            return redirect()->route('user.plates')->with('success', 'Plate updated successfully!');
        } catch (\Exception $e) {
            log()->error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function ajaxDestroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:plates,id'
        ]);

        $plate = Plate::findOrFail($request->id);

        // Make sure the plate belongs to the current user
        if ($plate->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this plate'
            ], 403);
        }

        $plate->delete();

        return response()->json([
            'success' => true,
            'message' => 'Plate deleted successfully'
        ]);
    }

    public function destroy($id, PlateService $plate)
    {

        try {
            $plate = $plate->deletePlate(id: $id);
            return redirect()->route("user.plates")->with("success", "The record has been deleted");
        } catch (\Exception $e) {
            log()->error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function updateSold(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:plates,id',
            'is_sold' => 'required|boolean'
        ]);

        $plate = Plate::findOrFail($request->id);

        // Make sure the plate belongs to the current user
        if ($plate->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this plate'
            ], 403);
        }

        $plate->is_sold = $request->is_sold;
        $plate->save();

        return response()->json([
            'success' => true,
            'message' => $request->is_sold == 1 ? 'Plate marked as sold' : 'Plate marked as not sold'
        ]);
    }

    public function updateVisibility(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:plates,id',
            'is_visible' => 'required|boolean'
        ]);

        $plate = Plate::findOrFail($request->id);

        // Make sure the plate belongs to the current user
        if ($plate->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this plate'
            ], 403);
        }

        $plate->is_visible = $request->is_visible;
        $plate->save();

        return response()->json([
            'success' => true,
            'message' => $request->is_visible == 1 ? 'Plate is now visible to buyers' : 'Plate is now hidden from buyers'
        ]);
    }


    public function getCodesByEmirate(Request $request)
    {
        $request->validate([
            'emirate_id' => 'required|exists:emirates,id'
        ]);

        $codes = Code::where('emirate_id', $request->emirate_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'success' => true,
            'codes' => $codes
        ]);
    }
}
