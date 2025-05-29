<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plate;
use App\Models\PlateView;
use App\Models\Emirate;
use App\Models\Code;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // User statistics
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
        $newUsersThisWeek = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        
        // Plate statistics
        $totalPlates = Plate::count();
        $activePlates = Plate::where('is_visible', true)
            ->where('is_approved', true)
            ->where('is_sold', false)
            ->count();
        $soldPlates = Plate::where('is_sold', true)->count();
        $pendingApproval = Plate::where('is_approved', false)->count();
        $featuredPlates = Plate::where('is_featured', true)->count();
        $premiumPlates = Plate::where('is_premium', true)->count();
        $urgentPlates = Plate::where('is_urgent', true)->count();
        
        // View statistics
        $totalViews = PlateView::count();
        $viewsToday = PlateView::whereDate('created_at', Carbon::today())->count();
        
        // Emirates and Codes statistics
        $totalEmirates = Emirate::count();
        $totalCodes = Code::count();
        
        // Most viewed plates
        $mostViewedPlates = Plate::withCount('views')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->with(['emirate', 'code', 'user'])
            ->get();
            
        // Recently added plates
        $recentPlates = Plate::with(['emirate', 'code', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Price statistics
        $priceStats = Plate::where('is_sold', false)
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->selectRaw('AVG(price) as average_price, MAX(price) as highest_price, MIN(price) as lowest_price')
            ->first();
            
        $averagePrice = $priceStats->average_price ? number_format($priceStats->average_price, 0) : 'N/A';
        $highestPrice = $priceStats->highest_price ? number_format($priceStats->highest_price, 0) : 'N/A';
        $lowestPrice = $priceStats->lowest_price ? number_format($priceStats->lowest_price, 0) : 'N/A';
        
        // Most active users
        $mostActiveUsers = User::withCount('plates')
            ->orderBy('plates_count', 'desc')
            ->take(5)
            ->get();
            
        return view('admin.pages.index', compact(
            'totalUsers', 'newUsersToday', 'newUsersThisWeek',
            'totalPlates', 'activePlates', 'soldPlates', 'pendingApproval',
            'featuredPlates', 'premiumPlates', 'urgentPlates',
            'totalViews', 'viewsToday',
            'totalEmirates', 'totalCodes',
            'mostViewedPlates', 'recentPlates',
            'averagePrice', 'highestPrice', 'lowestPrice',
            'mostActiveUsers'
        ));
    }
}
