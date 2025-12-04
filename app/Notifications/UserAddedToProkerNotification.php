<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\RoomProker;
use App\Models\Room;

class UserAddedToProkerNotification extends Notification
{
    use Queueable;

    protected $proker;
    protected $room;

    /**
     * Create a new notification instance.
     */
    public function __construct(RoomProker $proker, Room $room)
    {
        $this->proker = $proker;
        $this->room = $room;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     * ✅ JANGAN PASS OBJECT, HANYA PASS DATA PRIMITIF (string, int, dll)
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'proker_assignment',
            'title' => 'Bergabung ke Program Kerja!',
            'message' => 'Selamat! Anda telah bergabung ke proker "' . $this->proker->nama_proker . '" sebagai ' . ucfirst($notifiable->role) . ' di organisasi ' . $this->room->name . '.',
            // ✅ EXTRACT DATA DARI OBJECT (jangan pass object langsung!)
            'proker_id' => $this->proker->id,
            'proker_name' => $this->proker->nama_proker,
            'proker_year' => $this->proker->tahun,
            'room_id' => $this->room->id,
            'room_name' => $this->room->name,
            'user_role' => ucfirst($notifiable->role),
            'color' => 'green',
            'action_url' => route('user.dashboard'),
            'action_text' => 'Lihat Proker',
        ];
    }
}
