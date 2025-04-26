<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    public function index()
    {
        $plates = Plate::all();
        return response()->json($plates);
    }
    public function show($id)
    {
        $plate = Plate::find($id);
        if (!$plate) {
            return response()->json(['message' => 'Plate not found'], 404);
        }
    }

    public function store(Request $request)
    {

        return response()->json("this from controller", 200);
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric',
        //     'image' => 'required|string',
        // ]);
        // $plate = Plate::create($request->all());
        // return response()->json($plate, 201);
    }
}
