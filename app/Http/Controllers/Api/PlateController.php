<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlateRequest;
use Illuminate\Http\Request;
use App\Services\PlateService;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class PlateController extends Controller
{
    public function index(PlateService $plate)
    {
        $plates = $plate->getAllPlates();
        return response()->json($plates);
    }
    public function show($id)
    {
       
    }

    public function store(StorePlateRequest $request, PlateService $plate)
    {

        try {
        
            $validatedData = $request->validated(); 

            if($request->has('image')){
                $path = $request->file('image')->store('plates', 'public');
                $validatedData['image'] = $path;
            }
            
            $plate = $plate->createPlate($validatedData);
            
            return response()->json(['message'=> 'record has been add'],200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            // return response()->json(['message' => $e->getMessage()], 400);
            
            
        }


    }
}
