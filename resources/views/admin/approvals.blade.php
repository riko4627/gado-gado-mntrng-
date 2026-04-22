<x-layouts.admin>
    <div class="space-y-6">

        {{-- ── Header ──────────────────────────────────────────────────────── --}}
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white lg:text-3xl">
                    Manajemen Persetujuan
                </h1>
                <p class="text-slate-500 dark:text-slate-400">Kelola permintaan akses pengguna ke sistem
                    monitoring.</p>
            </div>
        </div>

        {{-- ── Toast Notifications ────────────────────────────────────────── --}}
        @if (session('toast_success'))
            <div id="toast-alert"
                class="flex items-center gap-3 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-semibold">{{ session('toast_success') }}</span>
            </div>
        @endif
        @if (session('toast_error'))
            <div id="toast-alert"
                class="flex items-center gap-3 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-700 dark:text-rose-400">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-semibold">{{ session('toast_error') }}</span>
            </div>
        @endif

        {{-- ── Status Summary Cards ────────────────────────────────────────── --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Pending --}}
            <a href="{{ route('admin.approvals', ['status' => 'pending']) }}"
                class="card-premium p-4 flex items-center gap-4 cursor-pointer hover:scale-[1.02] transition-transform {{ $statusFilter === 'pending' ? 'ring-2 ring-amber-400' : '' }}">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Pending</p>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $counts['pending'] }}</p>
                </div>
            </a>
            {{-- Approved --}}
            <a href="{{ route('admin.approvals', ['status' => 'approved']) }}"
                class="card-premium p-4 flex items-center gap-4 cursor-pointer hover:scale-[1.02] transition-transform {{ $statusFilter === 'approved' ? 'ring-2 ring-emerald-400' : '' }}">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Disetujui</p>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $counts['approved'] }}</p>
                </div>
            </a>
            {{-- Rejected --}}
            <a href="{{ route('admin.approvals', ['status' => 'rejected']) }}"
                class="card-premium p-4 flex items-center gap-4 cursor-pointer hover:scale-[1.02] transition-transform {{ $statusFilter === 'rejected' ? 'ring-2 ring-rose-400' : '' }}">
                <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Ditolak</p>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $counts['rejected'] }}</p>
                </div>
            </a>
            {{-- All --}}
            <a href="{{ route('admin.approvals', ['status' => 'all']) }}"
                class="card-premium p-4 flex items-center gap-4 cursor-pointer hover:scale-[1.02] transition-transform {{ $statusFilter === 'all' ? 'ring-2 ring-blue-400' : '' }}">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Total</p>
                    <p class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ $counts['all'] }}</p>
                </div>
            </a>
        </div>

        {{-- ── Users Table ─────────────────────────────────────────────────── --}}
        <div class="card-premium overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <h2 class="text-sm font-bold text-slate-900 dark:text-white">
                    @if($statusFilter === 'pending') Permintaan Pending
                    @elseif($statusFilter === 'approved') Pengguna Disetujui
                    @elseif($statusFilter === 'rejected') Pengguna Ditolak
                    @else Semua Pengguna
                    @endif
                    <span class="ml-2 text-xs font-medium px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">
                        {{ $users->total() }}
                    </span>
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-[10px] font-bold">
                        <tr>
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Terdaftar</th>
                            <th class="px-6 py-4">Disetujui pada</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($users as $user)
                            @php
                                $colors = ['blue', 'purple', 'emerald', 'orange', 'rose', 'amber'];
                                $color = $colors[abs(crc32($user->id)) % count($colors)];
                            @endphp
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                {{-- Pengguna --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-{{ $color }}-100 dark:bg-{{ $color }}-900/30 text-{{ $color }}-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <span
                                                class="text-sm font-semibold text-slate-900 dark:text-white truncate">{{ $user->name }}</span>
                                            <span
                                                class="text-xs text-slate-500 truncate">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                {{-- Status Badge --}}
                                <td class="px-6 py-4">
                                    @if ($user->status === 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold text-amber-600 bg-amber-500/10 rounded-lg">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            PENDING
                                        </span>
                                    @elseif ($user->status === 'approved')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-500/10 rounded-lg">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            DISETUJUI
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold text-rose-600 bg-rose-500/10 rounded-lg">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            DITOLAK
                                        </span>
                                    @endif
                                </td>
                                {{-- Terdaftar --}}
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $user->created_at->diffForHumans() }}
                                </td>
                                {{-- Approved At --}}
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $user->approved_at ? $user->approved_at->format('d M Y, H:i') : '-' }}
                                </td>
                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($user->status !== 'approved')
                                            <form method="POST"
                                                action="{{ route('admin.approve', $user->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-bold text-emerald-600 bg-emerald-500/10 hover:bg-emerald-500/20 rounded-lg transition-all"
                                                    onclick="return confirm('Setujui akses untuk {{ addslashes($user->name) }}?')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                        @if ($user->status !== 'rejected')
                                            <form method="POST"
                                                action="{{ route('admin.reject', $user->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="flex items-center gap-1.5 px-3 py-1.5 text-[11px] font-bold text-rose-600 bg-rose-500/10 hover:bg-rose-500/20 rounded-lg transition-all"
                                                    onclick="return confirm('Tolak akses untuk {{ addslashes($user->name) }}?')">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                        @if ($user->status === 'approved' && $user->status !== 'rejected')
                                            <span class="text-xs text-slate-400 italic">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-400">
                                        <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <p class="text-sm font-medium">Tidak ada pengguna dengan status ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($users->hasPages())
                <div
                    class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <span class="text-xs text-slate-500">Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }}
                        dari {{ $users->total() }} pengguna</span>
                    <div class="flex items-center gap-2">
                        @if ($users->onFirstPage())
                            <button
                                class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg opacity-50 cursor-not-allowed"
                                disabled>Sebelumnya</button>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"
                                class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Sebelumnya</a>
                        @endif

                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"
                                class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Berikutnya</a>
                        @else
                            <button
                                class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg opacity-50 cursor-not-allowed"
                                disabled>Berikutnya</button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Auto-dismiss toast --}}
    <script>
        setTimeout(() => {
            const el = document.getElementById('toast-alert');
            if (el) {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }
        }, 4000);
    </script>
</x-layouts.admin>
