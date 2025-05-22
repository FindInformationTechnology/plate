<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;
use App\Services\PlateService;
use Illuminate\Support\Facades\Auth;
use App\Models\PlateView;
use Illuminate\Support\Facades\App;


class FrontController extends Controller
{
    public function index(PlateService $plateService)
    {
     
       
        return view("front.index", ["plates" => Plate::all()]);
        
    }

    public function plates()
    {
        $plates = Plate::all();
        return view("front.plates", ["plates" => $plates]);
    }

    public function search(Request $request, PlateService $plateService)
    {
        // $plates = $plateService->searchPlates($request->input('search'));
        // return view("front.index", ["plates"=> $plates]);
    }

    public function show(Request $request, $id)
    {
        $plates = Plate::all();
        // Record view if not the owner
        $plate = Plate::findOrFail($id);
        if (Auth::id() !== $plate->user_id) {
            $this->recordView($plate);
        }

        return view("front.show",
        ["plate" => $plate, "plates" => $plates]);
    }

    public function dashboard(PlateService $plate)
    {
        $plates = $plate->getAllPlates();
        return view("front.dashboard", ["plates" => $plates]);
    }
    public function settings()
    {
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

    private function recordView(Plate $plate)
    {
        // Check if this IP has viewed this plate in the last 24 hours
        $viewed = PlateView::where('plate_id', $plate->id)
            ->where('ip_address', request()->ip())
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if (!$viewed) {
            PlateView::create([
                'plate_id' => $plate->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => Auth::id()
            ]);
        }
    }
}
