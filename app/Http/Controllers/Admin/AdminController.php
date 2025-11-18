<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Services\TimelineService; // <--- 1. Tambahkan Import ini

class AdminController extends Controller
{
    private DashboardService $dashboardService;
    private TimelineService $timelineService; // <--- 2. Tambahkan Property ini

    // 3. Update Constructor untuk inject TimelineService
    public function __construct(
        DashboardService $dashboardService,
        TimelineService $timelineService
    ) {
        $this->dashboardService = $dashboardService;
        $this->timelineService = $timelineService;
    }

    public function dashboard()
    {
        $stats   = $this->dashboardService->getStats();
        $rooms   = $this->dashboardService->getRoomsWithStats();
        $periods = $this->dashboardService->getPeriods();

        return view('admin.dashboard', compact('stats','rooms','periods'));
    }

    // 4. Update Method timeline() agar mengirim data
    public function timeline()
    {
        // Ambil data dari service
        $timelines = $this->timelineService->getTimelines();
        
        // Format data agar sesuai dengan view (untuk icon, warna, dll)
        $timeline_items = $this->timelineService->formatTimelines($timelines);

        // Kirim ke view
        return view('admin.timeline', [
            'timeline_items' => $timeline_items,
            'timelines' => $timelines,
        ]);
    }

    public function documents()
    {
        return view('admin.documents');
    }
}