<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Room;

class WelcomeNewMemberNotification extends Notification
{
    use Queueable;

    protected $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'welcome',
            'icon' => 'smile',
            'title' => '🎉 Selamat Datang di ' . $this->room->name . '!',
            'message' => 'Halo ' . $notifiable->name . '! Selamat bergabung sebagai ' . ucfirst($notifiable->role) . ' di ' . $this->room->name . '. Anda sekarang dapat melihat dan mengelola program kerja yang ditugaskan kepada Anda.',
            'room_id' => $this->room->id,
            'room_name' => $this->room->name,
            'action' => 'view_myprokers',
            'action_text' => '📋 Lihat Program Kerja Saya',
            'action_url' => route('user.myprokers'),
        ];
    }
}
