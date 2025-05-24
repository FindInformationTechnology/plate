<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Plate;
use Illuminate\Http\Request;
use App\Services\PlateService;
use Illuminate\Support\Facades\Auth;
use App\Models\PlateView;
use Illuminate\Support\Facades\App;


class FrontController extends Controller
{

    public function search(Request $request)
    {
        // Get all the input values from the form
        $emirateId = $request->input('emirate_id');
        $codeId = $request->input('code_id');
        $length = $request->input('length');
        $maxPrice = $request->input('max_price');
        $minPrice = $request->input('min_price');
        $startWith = $request->input('start_with');
        $endWith = $request->input('end_with');

        // Start building the query
        $query = Plate::query();

        // Apply filters based on the input values
        if ($emirateId) {
            $query->where('emirate_id', $emirateId);
        }

        if ($codeId) {
            $query->where('code_id', $codeId);
        }

        if ($length) {
            $query->where('length', $length);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice); // Use 'price' instead of 'price_digits'
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice); // Use 'price' instead of 'price_digits'
        }

        if ($startWith) {
            $query->where('number', 'like', $startWith . '%');
        }

        if ($endWith) {
            $query->where('number', 'like', '%' . $endWith);
        }

        // Get the search results
        $plates = $query->get();

        // Pass the search results to the view
        return view('front.search', compact('plates'));
    }
    
    public function index(PlateService $plateService)
    {
     
       
        return view("front.index", ["plates" => Plate::all()]);
        
    }

    public function plates()
    {
        $plates = Plate::all();
        return view("front.plates", ["plates" => $plates]);
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

    

    public function getCodes($emirate_id)
    {
        // Fetch codes based on emirate_id
        $codes = Code::where('emirate_id', $emirate_id)->get();

        // Return the codes as JSON
        return response()->json($codes);
    }
}
