<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display all notifications for authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get all notifications (read + unread)
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        // Count unread
        $unreadCount = $user->unreadNotifications->count();
        
        return view('user.Notification', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark notification as read and redirect based on action_url
     */
    public function read($notificationId)
    {
        $user = Auth::user();
        
        $notification = $user->notifications()->find($notificationId);
        
        if (!$notification) {
            return redirect()
                ->route('user.notifications')
                ->with('error', 'Notifikasi tidak ditemukan.');
        }
        
        // Mark as read
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        
        // ✅ REDIRECT BERDASARKAN action_url DARI NOTIFIKASI
        $data = $notification->data;
        $actionUrl = $data['action_url'] ?? route('user.myprokers');
        
        return redirect($actionUrl)
            ->with('success', 'Notifikasi telah dibaca.');
    }

    /**
     * Mark all notifications as read
     */
    public function readAll()
    {
        $user = Auth::user();
        
        $user->unreadNotifications->markAsRead();
        
        return redirect()
            ->route('user.notifications')
            ->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Delete a notification
     */
    public function destroy($notificationId)
    {
        $user = Auth::user();
        
        $notification = $user->notifications()->find($notificationId);
        
        if ($notification) {
            $notification->delete();
            
            return redirect()
                ->route('user.notifications')
                ->with('success', 'Notifikasi berhasil dihapus.');
        }
        
        return redirect()
            ->route('user.notifications')
            ->with('error', 'Notifikasi tidak ditemukan.');
    }

    /**
     * Get unread notification count (for AJAX)
     */
    public function unreadCount()
    {
        $user = Auth::user();
        $count = $user->unreadNotifications->count();
        
        return response()->json(['count' => $count]);
    }
}
