<?php
namespace App\Services\User;

use App\Models\User; use App\Models\Document; use App\Models\DocumentStatus; use App\Models\Timeline; use App\Models\RoomMember;
use Illuminate\Http\UploadedFile; use Illuminate\Support\Facades\Storage;

class UserDocumentService
{
    public function getAllDocuments(User $user, ?string $status=null) {/* ...lihat template sebelumnya... */}
    public function createDocument(User $user, int $roomId, array $data, ?UploadedFile $file=null): Document {/*...*/}
    public function updateDocument(User $user, int $documentId, array $data, ?UploadedFile $file=null): Document {/*...*/}
    public function deleteDocument(User $user, int $documentId): bool {/*...*/}
}
