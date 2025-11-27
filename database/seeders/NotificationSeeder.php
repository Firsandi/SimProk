<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::create([
            'user_id' => 1,
            'type' => 'document_revision',
            'title' => 'Proposal PPMB butuh revisi',
            'message' => 'Cek kembali struktur rundown dan anggaran.',
            'data' => ['document_id' => 1],
            'action_url' => '/documents/1',
            'read_at' => null,
        ]);
    }
}
