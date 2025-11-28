@extends('layouts.user')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <h1>My Prokers</h1>
            <p>Kelola program kerja dan dokumen Anda</p>
        </div>
        <div class="header-right">
            <div class="notification-badge">
                <i class="fas fa-bell"></i>
                <span class="badge">{{ auth()->user()->getUnreadNotificationsCount() }}</span>
            </div>
            <div class="user-profile">
                <div class="avatar">{{ auth()->user()->getInitial() }}</div>
                <div>
                    <div style="font-weight: bold; color: var(--primary-dark);">
                        {{ auth()->user()->name }}
                    </div>
                    <div style="font-size: 0.75rem; color: var(--gray-dark);">
                        Mahasiswa {{ optional(auth()->user()->joinedRooms->first())->name ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <div class="section-title" style="margin-bottom: 0;">
            <i class="fas fa-briefcase"></i>Program Kerja Saya
        </div>
        <div class="view-toggle">
            <button class="view-btn active" onclick="switchView('grid')">
                <i class="fas fa-th"></i>Grid
            </button>
            <button class="view-btn" onclick="switchView('list')">
                <i class="fas fa-list"></i>List
            </button>
        </div>
    </div>

    <!-- Prokers Grid -->
    <div class="prokers-grid">
        @forelse($myProkers as $proker)
            @php
                $colors = ['blue', 'purple', 'pink', 'orange'];
                $color = $colors[$loop->index % count($colors)];
                $progress = $proker->progress ?? 0;
            @endphp

            <div class="proker-card">
                <div class="proker-header {{ $color }}">
                    <div class="proker-info">
                        <h3>{{ $proker->name }}</h3>
                        <div class="proker-subtitle">{{ $proker->description ?? '-' }}</div>
                    </div>
                    <div class="role-badge">
                        <i class="fas fa-user-tag"></i>{{ $proker->pivot->role ?? 'Anggota' }}
                    </div>
                </div>
                <div class="proker-body">
                    <div class="proker-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar" style="color: var(--primary); font-size: 0.875rem;"></i>
                            <div>
                                <div class="meta-label">Periode</div>
                                <div class="meta-value">{{ $proker->period ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-circle-dot" style="color: var(--primary); font-size: 0.875rem;"></i>
                            <div>
                                <div class="meta-label">Organisasi</div>
                                <div class="meta-value">{{ optional($proker->room)->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <span class="status-badge {{ $proker->status === 'completed' ? 'status-completed' : 'status-ongoing' }}">
                        <i class="fas fa-circle-dot"></i>{{ ucfirst($proker->status) }}
                    </span>

                    <div class="proker-stats">
                        <div class="stat-item">
                            <div class="stat-value">{{ $proker->documents->count() }}</div>
                            <div class="stat-label">Dokumen</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">{{ $proker->tasks_count ?? 0 }}</div>
                            <div class="stat-label">Task</div>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <div class="progress-text">
                            <span>Progress</span>
                            <span style="font-weight: 600;">{{ $progress }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $progress }}%;"></div>
                        </div>
                    </div>

                    <div class="proker-actions">
                        <a href="{{ route('user.document.create', $proker->id) }}" class="btn btn-secondary">
                            <i class="fas fa-file-upload"></i>Upload
                        </a>
                        <a href="{{ route('user.rooms.show', $proker->room_id) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right"></i>Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-briefcase"></i></div>
                <div class="empty-title">Belum ada proker</div>
                <div class="empty-desc">Anda belum terdaftar dalam program kerja apapun.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
