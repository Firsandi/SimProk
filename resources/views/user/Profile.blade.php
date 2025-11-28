@extends('layouts.user')

@section('title', 'Profile')
@section('page-title', 'Profile')
@section('page-subtitle', 'Informasi akun Anda')

@section('content')
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Profil Pengguna</h3>
        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
    </div>
@endsection
