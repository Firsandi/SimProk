<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService; 

class AdminController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function dashboard()
    {
        $stats   = $this->dashboardService->getStats();
        $rooms   = $this->dashboardService->getRoomsWithStats();
        $periods = $this->dashboardService->getPeriods();

        return view('admin.dashboard', compact('stats','rooms','periods'));
    }
    public function timeline()
    {
        return view('admin.timeline');
    }

    public function documents()
    {
        return view('admin.documents');
    }
}
