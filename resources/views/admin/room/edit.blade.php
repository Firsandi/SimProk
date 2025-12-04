@extends('layouts.admin')

@section('content')
<div class="mx-auto max-w-screen-md px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="flex flex-col justify-between gap-3 mb-6 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">✏️ Edit UKM / Ormawa</h2>
            <p class="text-sm text-gray-500">
                Perbarui informasi nama, periode, dan status aktif UKM / Ormawa.
            </p>
        </div>
        <a
            href="{{ route('admin.room.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 transition bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali ke daftar
        </a>
    </div>

    <!-- Card Form -->
    <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">
            <h3 class="text-lg font-semibold text-gray-900">Form Edit UKM / Ormawa</h3>
            <p class="text-xs text-gray-500">
                Pastikan data sesuai dengan SK dan periode kepengurusan yang berlaku.
            </p>
        </div>

        <form
            action="{{ route('admin.room.update', $room->id) }}"
            method="POST"
            onsubmit="return confirmAction(this, {
                text: 'Perubahan akan menggantikan data sebelumnya.',
                confirmText: 'Ya, update',
            });"
            class="px-6 py-5 space-y-5"
        >
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Nama
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $room->name) }}"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    placeholder="Masukkan nama UKM / Ormawa"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Periode -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Periode
                </label>
                <input
                    type="text"
                    name="period"
                    value="{{ old('period', $room->period) }}"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    placeholder="Contoh: 2024/2025"
                    required
                >
                @error('period')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1 text-sm font-semibold text-gray-800">
                    Status
                </label>
                <select
                    name="status"
                    class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500"
                    required
                >
                    <option value="active" {{ old('status', $room->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive" {{ old('status', $room->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <a
                    href="{{ route('admin.room.index') }}"
                    class="px-6 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700"
                >
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
