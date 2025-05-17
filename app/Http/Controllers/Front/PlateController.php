<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlateRequest;
use App\Models\Plate;
use App\Services\PlateService;
use Illuminate\Http\Request;

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
                'code' => 'required|string',
                'price' => 'required',
                'image' => 'nullable|image|max:8192',

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

    public function show(Plate $plate) {}

    public function edit($id, PlateService $plate)
    {

        return view("user.plate.edit", ["plate" => $plate->getPlateById($id)]);
    }
    public function update(Request $request, $id, PlateService $plate)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'emirate_id' => 'required|integer',
                'number' => 'required|string',
                'code' => 'required|string',
                'price' => 'required',
                'image' => 'nullable|image|max:8192',
            ]);
            if ($request->has('image')) {
                $path = $request->file('image')->store('plates', 'public');
                $validated['image'] = $path;
            }

            $plate = $plate->updatePlate($id, $validated);

            return redirect()->route("user.plates")->with("success", "The record has been updated");
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
}
