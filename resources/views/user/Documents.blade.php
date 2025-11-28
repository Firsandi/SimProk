@extends('layouts.user')

@section('title', 'Documents')
@section('page-title', 'Documents')
@section('page-subtitle', 'Daftar dokumen program kerja')

@section('content')
    <div class="bg-white rounded-xl shadow-sm divide-y">
        @foreach($documents as $document)
            @include('components.user.document-item', ['document' => $document])
        @endforeach
    </div>
@endsection
