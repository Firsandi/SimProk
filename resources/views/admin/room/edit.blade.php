@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">Edit UKM / Ormawa</h2>
    <form action="{{ route('admin.room.update', $room->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="name" value="{{ $room->name }}" 
                   class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Periode</label>
            <input type="text" name="period" value="{{ $room->period }}" 
                   class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active" {{ $room->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $room->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Update
        </button>
    </form>
</div>
@endsection
