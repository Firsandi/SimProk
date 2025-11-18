<?php
namespace App\Services\User;
use App\Models\User; use App\Models\Room; use App\Models\RoomMember;

class UserRoomService
{
    public function getAllRooms(User $user) {/* ...lihat template sebelumnya... */}
    public function getRoomDetail(User $user, int $roomId) {/* ...lihat template sebelumnya... */}
    public function joinRoom(User $user, string $inviteCode): bool {/* ...lihat template sebelumnya... */}
}
