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
        // Gather input with validation
        $emirateId = $request->input('emirate_id');
        $codeId = $request->input('code_id');
        $length = $request->input('length');
        $maxPrice = $request->input('max_price');
        $minPrice = $request->input('min_price');
        $startWith = $request->input('start_with');
        $endWith = $request->input('end_with');
        $format = $request->input('format');

        // Start query with active plates only
        $query = Plate::select(['id', 'emirate_id', 'code_id', 'number', 'price'])
            ->with(['emirate', 'code'])
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false);

        // Apply basic filters
        $this->applyBasicFilters($query, $emirateId, $codeId, $length, $maxPrice, $minPrice, $startWith, $endWith);

        // Apply format-based filters
        if ($format) {
            $this->applyFormatFilter($query, $format);
        }

        // Get results with pagination
        $plates = $query->orderBy('created_at', 'desc')->get();

        // Pass search results and current filters to view
        return view('front.search', compact('plates'));
    }

    /**
     * Apply basic search filters
     */
    private function applyBasicFilters($query, $emirateId, $codeId, $length, $maxPrice, $minPrice, $startWith, $endWith)
    {
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
            $query->where('price', '<=', $maxPrice);
        }
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($startWith) {
            $query->where('number', 'like', $startWith . '%');
        }
        if ($endWith) {
            $query->where('number', 'like', '%' . $endWith);
        }
    }

    /**
     * Apply format-based filters with proper MySQL regex
     */
    private function applyFormatFilter($query, $format)
    {
        switch ($format) {
            // Repeat patterns - improved regex
            case 'repeat_2':
                $query->whereRaw("(
                    (number REGEXP '(.).*\\1' AND LENGTH(number) - LENGTH(REPLACE(number, SUBSTRING(number, 1, 1), '')) = 2) OR
                    (number REGEXP '.(.).*\\1' AND LENGTH(number) - LENGTH(REPLACE(number, SUBSTRING(number, 2, 1), '')) = 2) OR
                    (number REGEXP '..(.).*\\1' AND LENGTH(number) - LENGTH(REPLACE(number, SUBSTRING(number, 3, 1), '')) = 2) OR
                    (number REGEXP '...(.).*\\1' AND LENGTH(number) - LENGTH(REPLACE(number, SUBSTRING(number, 4, 1), '')) = 2) OR
                    (number REGEXP '....(.).*\\1' AND LENGTH(number) - LENGTH(REPLACE(number, SUBSTRING(number, 5, 1), '')) = 2)
                )");
                break;
            case 'repeat_3':
                $query->whereRaw("(
                    LENGTH(number) - LENGTH(REPLACE(number, '0', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '1', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '2', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '3', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '4', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '5', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '6', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '7', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '8', '')) = 3 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '9', '')) = 3
                )");
                break;
            case 'repeat_4':
                $query->whereRaw("(
                    LENGTH(number) - LENGTH(REPLACE(number, '0', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '1', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '2', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '3', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '4', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '5', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '6', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '7', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '8', '')) = 4 OR
                    LENGTH(number) - LENGTH(REPLACE(number, '9', '')) = 4
                )");
                break;

            // 3-digit patterns
            case 'x_y_z_3_Digits':
                $query->where('length', 3)
                    ->whereRaw("SUBSTRING(number, 1, 1) != SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 2, 1) != SUBSTRING(number, 3, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) != SUBSTRING(number, 3, 1)");
                break;
            case 'x_y_y_3_Digits':
                $query->where('length', 3)
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 3, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) != SUBSTRING(number, 2, 1)");
                break;
            case 'x_x_y_3_Digits':
                $query->where('length', 3)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) != SUBSTRING(number, 3, 1)");
                break;
            case 'x_x_x_3_Digits':
                $query->where('length', 3)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 3, 1)");
                break;

            // 4-digit patterns
            case 'x_any_any_x':
                $query->where('length', 4)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 4, 1)");
                break;
            case 'x_y_y_x_4_Digits':
                $query->where('length', 4)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 4, 1)")
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 3, 1)");
                break;
            case '?_x_x_?_4_Digits':
                $query->where('length', 4)
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 3, 1)");
                break;
            case 'x_y_y_y_4_Digits':
                $query->where('length', 4)
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 3, 1)")
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 4, 1)");
                break;
            case 'x_x_x_y_4_Digits':
                $query->where('length', 4)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 3, 1)");
                break;

            // 5-digit patterns
            case 'x_any_any_any_x':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 5, 1)");
                break;
            case 'x_y_z_y_x':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 5, 1)")
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 4, 1)")
                    ->whereRaw("SUBSTRING(number, 3, 1) != SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 3, 1) != SUBSTRING(number, 1, 1)");
                break;
            case 'x_x_z_x_x':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 4, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 5, 1)")
                    ->whereRaw("SUBSTRING(number, 3, 1) != SUBSTRING(number, 1, 1)");
                break;
            case 'any_x_x_x_any':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 3, 1)")
                    ->whereRaw("SUBSTRING(number, 2, 1) = SUBSTRING(number, 4, 1)");
                break;
            case 'any_any_x_x_x':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 3, 1) = SUBSTRING(number, 4, 1)")
                    ->whereRaw("SUBSTRING(number, 3, 1) = SUBSTRING(number, 5, 1)");
                break;
            case 'xxx??_5_Digits':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 3, 1)");
                break;
            case 'xxxxx_5_Digits':
                $query->where('length', 5)
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 2, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 3, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 4, 1)")
                    ->whereRaw("SUBSTRING(number, 1, 1) = SUBSTRING(number, 5, 1)");
                break;
        }
    }

    public function index(PlateService $plateService)
    {
        // Get the latest plates with pagination (12 per page)
        $plates = Plate::select(['id', 'emirate_id', 'code_id', 'number', 'price'])
            ->with(['emirate', 'code'])
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false)
            ->latest()  // Order by created_at DESC
            ->paginate(12);


        // Get featured plates (for example, most viewed or premium)
        $featuredPlates = Plate::select(['id', 'emirate_id', 'code_id', 'number', 'price'])
            ->with(['emirate', 'code'])
            ->where('is_featured', true)
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false)
            ->withCount('views')  // This adds a views_count column to the result
            ->orderBy('views_count', 'desc')  // Now we can order by it
            ->take(4)
            ->get();





        return view("front.index", [
            "plates" => $plates,
            "featuredPlates" => $featuredPlates
        ]);
    }

    public function plates()
    {
        $plates = Plate::select(['id', 'emirate_id', 'code_id', 'number', 'price'])
            ->with(['emirate', 'code'])
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false)
            ->latest()  // Order by created_at DESC
            ->paginate(21);
        return view("front.plates", compact('plates'));
    }

    public function show(Request $request, $id)
    {
        // Validate that ID is numeric and exists
        if (!is_numeric($id)) {
            abort(404);
        }

        // Find plate or fail with 404
        $plate = Plate::where('id', $id)
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->first();

        if (!$plate) {
            abort(404);
        }

        // Record view if not the owner
        if (Auth::id() !== $plate->user_id) {
            $this->recordView($plate);
        }

        // Get related plates by same emirate
        $relatedByEmirate = Plate::select(['id', 'emirate_id', 'code_id', 'number', 'price'])
            ->with(['emirate', 'code'])
            ->where('emirate_id', $plate->emirate_id)
            ->where('id', '!=', $plate->id)
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false)
            ->latest()
            ->take(4)
            ->get();

        // Get similar plates by price range
        $similarByPrice = Plate::select(['id', 'emirate_id', 'code_id', 'number', 'price'])
            ->with(['emirate', 'code'])
            ->whereBetween('price', [$plate->price * 0.8, $plate->price * 1.2])
            ->where('id', '!=', $plate->id)
            ->where('emirate_id', '!=', $plate->emirate_id) // Different emirate for variety
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false)
            ->latest()
            ->take(4)
            ->get();

        return view(
            "front.show",
            [
                "plate" => $plate,
                "relatedByEmirate" => $relatedByEmirate,
                "similarByPrice" => $similarByPrice
            ]
        );
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


    /**
     * Handle missing contact method
     */
    public function contact()
    {
        return view('front.contact');
    }

    /**
     * Get codes by emirate (AJAX endpoint)
     */
    public function getCodes($emirate_id)
    {
        if (!is_numeric($emirate_id)) {
            return response()->json(['error' => 'Invalid emirate ID'], 400);
        }

        $codes = \App\Models\Code::where('emirate_id', $emirate_id)->get();
        return response()->json($codes);
    }
}
