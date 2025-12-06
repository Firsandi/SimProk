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

    public function __construct(RoomProker $proker, Room $room)
    {
        $this->proker = $proker;
        $this->room = $room;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'proker_assignment',
            'title' => 'Bergabung ke Program Kerja!',
            'message' => 'Selamat! Anda telah bergabung ke proker "' . $this->proker->nama_proker . '" sebagai ' . ucfirst($notifiable->role) . ' di organisasi ' . $this->room->name . '.',
            'proker_id' => $this->proker->id,
            'proker_name' => $this->proker->nama_proker,
            'proker_year' => $this->proker->tahun,
            'room_id' => $this->room->id,
            'room_name' => $this->room->name,
            'user_role' => ucfirst($notifiable->role),
            'color' => 'green',
            'action_url' => route('user.myprokers'), // ✅ FIX INI
            'action_text' => 'Lihat My Prokers',
        ];
    }
}
