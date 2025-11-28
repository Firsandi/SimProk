@extends('layouts.admin')

@section('content')
<div class="max-w-lg p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-xl font-semibold">Tambah UKM / Ormawa</h2>
    <form action="{{ route('admin.room.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="name" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div>
            <label class="block text-gray-700">Jenis Organisasi</label>
            <select name="organization_type" class="w-full px-3 py-2 border rounded" required>
                <option value="ukm">UKM</option>
                <option value="ormawa">Ormawa</option>
            </select>
        </div>
        <div>
            <label class="block text-gray-700">Periode</label>
            <input type="text" name="period" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div>
            <label class="block text-gray-700">Status</label>
            <select name="status" class="w-full px-3 py-2 border rounded">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <input type="hidden" name="color" value="blue">
        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
            Simpan
        </button>
    </form>
</div>
@endsection
