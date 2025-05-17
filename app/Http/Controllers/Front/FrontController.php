<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;
use App\Services\PlateService;


class FrontController extends Controller
{
    public function index(PlateService $plateService) {
        
        return view("front.index", ["plates"=> Plate::all()]);

    }

    public function plates() {
        $plates = Plate::all();
        return view("front.plates", ["plates"=> $plates]);
    }

    public function search(Request $request, PlateService $plateService) {
        // $plates = $plateService->searchPlates($request->input('search'));
        // return view("front.index", ["plates"=> $plates]);
    }

    public function show($id, PlateService $plateService) {
        $plate = $plateService->getPlateById($id);
        return view("front.show", ["plate"=> $plate]);
    }

    public function dashboard(PlateService $plate) {
        $plates = $plate->getAllPlates();
        return view("front.dashboard", ["plates"=> $plates]);
    }
    public function settings() {
        return view("front.settings");
    }
    
    public function register()
    {
        return view('front.register');
    }

    public function login(Request $request)
    {
        return view('front.login');
    }
}
