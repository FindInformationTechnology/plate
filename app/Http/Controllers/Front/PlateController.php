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
    public function index(PlateService $plate){
        // return"test";
        return view("user.plate.index", ["plates"=> $plate->getAllPlates()]);
        
    }

    public function create () {
        return view("user.plate.create");
    }

    public function store(StorePlateRequest $request, PlateService $plate){

        try {
            //code..  
            
            $validatedData = $request->validated();

            if($request->has('image')){
                $path = $request->file('image')->store('plates', 'public');
                $validatedData['image'] = $path;
            }
            
            $plate->createPlate($validatedData);

            return redirect()->route("plates")->with("success","The record has been added");

        } catch (\Exception $e) {
            log()->error($e->getMessage());
            return redirect()->route("plates")->with("error","Something went wrong");
        }
    }
      
}
