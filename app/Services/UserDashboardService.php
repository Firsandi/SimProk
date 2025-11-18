<?php
namespace App\Services\User;

use App\Models\User;
use App\Models\RoomMember;
use App\Models\Document;
use Carbon\Carbon;

class UserDashboardService
{
    public function getDashboardStats(User $user): array {
        $roomIds = RoomMember::where('user_id', $user->id)->pluck('room_id');
        $totalRooms = $roomIds->count();
        $totalDocuments = Document::where('submitted_by', $user->id)->count();
        $pendingDocuments = Document::where('submitted_by', $user->id)
            ->whereHas('latestStatus', fn($q)=>$q->where('status','pending'))->count();
        $upcomingDeadlines = Document::whereIn('room_id',$roomIds)
            ->where('submitted_by',$user->id)
            ->whereHas('latestStatus',fn($q)=>$q->where('status','pending'))
            ->where('submitted_at','>',now())
            ->count();
        return [
            'total_rooms'=>$totalRooms,
            'documents_submitted'=>$totalDocuments,
            'pending_documents'=>$pendingDocuments,
            'upcoming_deadlines'=>$upcomingDeadlines,
        ];
    }
    public function getUserRooms(User $user) {/* ...implement seperti jawaban sebelumnya... */}
    public function getRecentDocuments(User $user, int $limit=5) {/* ...implementasi... */}
    public function getUpcomingDeadlines(User $user, int $limit=5) {/* ...implementasi... */}
}
