<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentStatus;

class DocumentStatusSeeder extends Seeder
{
    public function run(): void
    {
        DocumentStatus::create([
            'document_id' => 1,
            'status' => 'revision',
            'reviewed_by' => 1,
            'notes' => 'Perlu revisi rundown dan anggaran',
            'reviewed_at' => now(),
        ]);

        DocumentStatus::create([
            'document_id' => 2,
            'status' => 'approved',
            'reviewed_by' => 1,
            'notes' => 'Sudah disetujui oleh admin',
            'reviewed_at' => now(),
        ]);
    }
}
