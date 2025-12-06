<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomProker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_proker',
        'tahun',
        'deskripsi',
        'user_id',
        'room_id',
    ];

    // Accessor agar view tetap pakai $proker->name
    public function getNameAttribute()
    {
        return $this->nama_proker;
    }

    public function getPeriodAttribute()
    {
        return $this->tahun;
    }

    public function getDescriptionAttribute()
    {
        return $this->deskripsi;
    }

    //  Status dynamic berdasarkan progress
    public function getStatusAttribute()
    {
        // Completed jika kedua role sudah 100%
        if ($this->progress == 100 && $this->bendahara_progress == 100) {
            return 'completed';
        } elseif ($this->progress > 0 || $this->bendahara_progress > 0) {
            return 'ongoing';
        } else {
            return 'planning';
        }
    }

    //  Progress SEKRETARIS: Upload = 25%, Approved = +25% (per dokumen)
    public function getProgressAttribute()
    {
        $progress = 0;

        // Cek apakah Proposal sudah diupload
        $proposalExists = $this->documents()
            ->where('document_type', 'proposal')
            ->exists();

        // Cek apakah Proposal sudah approved
        $proposalApproved = $this->documents()
            ->where('document_type', 'proposal')
            ->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))
            ->exists();

        // Cek apakah LPJ sudah diupload
        $lpjExists = $this->documents()
            ->where('document_type', 'lpj')
            ->exists();

        // Cek apakah LPJ sudah approved
        $lpjApproved = $this->documents()
            ->where('document_type', 'lpj')
            ->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))
            ->exists();

        // Progress Sekretaris
        if ($proposalExists) $progress += 25;      // Upload Proposal = 25%
        if ($proposalApproved) $progress += 25;    // Proposal Approved = 50%
        if ($lpjExists) $progress += 25;           // Upload LPJ = 75%
        if ($lpjApproved) $progress += 25;         // LPJ Approved = 100%

        return $progress;
    }

    //  Progress BENDAHARA
    public function getBendaharaProgressAttribute()
    {
        $progress = 0;

        // Cek apakah Layout BPP sudah diupload
        $layoutBppExists = $this->documents()
            ->where('document_type', 'layout_bpp')
            ->exists();

        // Cek apakah Layout BPP sudah approved
        $layoutBppApproved = $this->documents()
            ->where('document_type', 'layout_bpp')
            ->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))
            ->exists();

        // Cek apakah SPJ sudah diupload
        $spjExists = $this->documents()
            ->where('document_type', 'spj')
            ->exists();

        // Cek apakah SPJ sudah approved
        $spjApproved = $this->documents()
            ->where('document_type', 'spj')
            ->whereHas('latestStatus', fn($q) => $q->where('status', 'approved'))
            ->exists();

        // Progress Bendahara
        if ($layoutBppExists) $progress += 25;     // Upload Layout BPP = 25%
        if ($layoutBppApproved) $progress += 25;   // Layout BPP Approved = 50%
        if ($spjExists) $progress += 25;           // Upload SPJ = 75%
        if ($spjApproved) $progress += 25;         // SPJ Approved = 100%

        return $progress;
    }

    //  Cek apakah proker sudah completed (kedua role 100%)
    public function isCompleted()
    {
        return $this->progress == 100 && $this->bendahara_progress == 100;
    }

    // Relations
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'proker_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi anggota proker via pivot proker_members
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'proker_members', 'proker_id', 'user_id')
            ->withPivot('role')
            ->withTimestamps();
    }
}
