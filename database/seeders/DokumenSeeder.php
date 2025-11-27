<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        Document::create([
            'room_id' => 1,
            'proker_id' => 1,
            'title' => 'Proposal PPMB',
            'document_type' => 'proposal',
            'file_path' => 'documents/proposal_ppmb.pdf',
            'submitted_by' => 2,
            'submitted_at' => now()->subDays(3),
            'notes' => 'Butuh revisi rundown',
        ]);

        Document::create([
            'room_id' => 1,
            'proker_id' => 2,
            'title' => 'SPJ TIC',
            'document_type' => 'spj',
            'file_path' => 'documents/spj_tic.pdf',
            'submitted_by' => 3,
            'submitted_at' => now()->subDays(2),
            'notes' => null,
        ]);
    }
}
