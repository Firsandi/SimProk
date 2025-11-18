@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah UKM / Ormawa</h2>
    <form action="{{ route('admin.room.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Jenis Organisasi</label>
            <select name="organization_type" class="w-full border rounded px-3 py-2" required>
                <option value="ukm">UKM</option>
                <option value="ormawa">Ormawa</option>
            </select>
        </div>
        <div>
            <label class="block text-gray-700">Periode</label>
            <input type="text" name="period" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <input type="hidden" name="color" value="blue">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Simpan
        </button>
    </form>
</div>
@endsection
