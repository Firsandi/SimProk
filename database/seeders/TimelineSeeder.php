<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timeline;

class TimelineSeeder extends Seeder
{
    public function run(): void
    {
        Timeline::create([
            'room_id' => 1,
            'activity_type' => 'document_uploaded',
            'title' => 'Proposal PPMB diunggah',
            'description' => 'Sekretaris mengunggah proposal kegiatan PPMB',
            'actor_id' => 2,
            'document_id' => 1,
        ]);
    }
}
