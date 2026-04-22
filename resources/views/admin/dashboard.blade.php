<x-layouts.admin>
    <div class="space-y-6">

        {{-- ═══════════════════════════════════════════════════
             HEADER SECTION
        ═══════════════════════════════════════════════════ --}}
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-blue-50 lg:text-3xl">
                    Dashboard Overview
                </h1>
                <p class="text-slate-600 dark:text-slate-400">
                    Selamat datang, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>.
                    Ringkasan sistem UWN Monitoring per {{ now()->translatedFormat('l, j F Y') }}.
                </p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Indikator waktu --}}
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 text-xs font-medium bg-white dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-500 dark:text-slate-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ now()->format('H:i') }} WIB
                </div>
                @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('admin.approvals') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Kelola Approval
                    @if($stats['pending_users'] > 0)
                        <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold bg-white/20 rounded-full">
                            {{ $stats['pending_users'] }}
                        </span>
                    @endif
                </a>
                @endif
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════
             STATS CARDS — User Data (dari Database)
        ═══════════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Card: Total User --}}
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-2.5 bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-500/10 px-2 py-0.5 rounded-full">
                        Sistem
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Pengguna</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['total_users'] }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">
                        {{ $stats['super_admins'] }} Super Admin · {{ $stats['admins'] }} Admin · {{ $stats['users'] }} User
                    </p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-colors"></div>
            </div>

            {{-- Card: User Approved --}}
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-2.5 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-500/10 px-2 py-0.5 rounded-full">
                        Aktif
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Pengguna Disetujui</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['approved_users'] }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">
                        @if($stats['total_users'] > 0)
                            {{ round(($stats['approved_users'] / $stats['total_users']) * 100) }}% dari total pengguna
                        @else
                            Belum ada data
                        @endif
                    </p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-colors"></div>
            </div>

            {{-- Card: User Pending --}}
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-2.5 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    @if($stats['pending_users'] > 0)
                        <span class="text-xs font-bold text-amber-600 bg-amber-500/10 px-2 py-0.5 rounded-full animate-pulse">
                            Perlu Aksi
                        </span>
                    @else
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-full">
                            Bersih
                        </span>
                    @endif
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Menunggu Persetujuan</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['pending_users'] }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">
                        Akun baru menunggu verifikasi admin
                    </p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/10 transition-colors"></div>
            </div>

            {{-- Card: User Rejected --}}
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-2.5 bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-rose-500 bg-rose-500/10 px-2 py-0.5 rounded-full">
                        Ditolak
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Akses Ditolak</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stats['rejected_users'] }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">
                        Permintaan akses yang ditolak
                    </p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl group-hover:bg-rose-500/10 transition-colors"></div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════
             STATS CARDS — Proyektor (dari API Eksternal)
        ═══════════════════════════════════════════════════ --}}
        {{-- <div>
            <div class="flex items-center gap-3 mb-3">
                <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Statistik Proyektor</h2>
                <div class="flex-1 h-px bg-slate-200 dark:bg-slate-800"></div>
                <div id="proyektor-status" class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    <span class="w-2 h-2 rounded-full bg-slate-300 animate-pulse"></span>
                    Memuat...
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3" id="proyektor-grid"></div>
        </div> --}}

        {{-- ═══════════════════════════════════════════════════
             CONTENT GRID — Tabel User & Pending Approvals
        ═══════════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Tabel Pengguna Terbaru --}}
            <div class="lg:col-span-2 card-premium overflow-hidden">
                <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-5 bg-blue-600 rounded-full"></div>
                        <h3 class="font-bold text-slate-800 dark:text-white">Pengguna Terbaru (Approved)</h3>
                    </div>
                    <a href="/admin/users" class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors flex items-center gap-1">
                        Lihat Semua
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-[10px] font-bold tracking-wider">
                            <tr>
                                <th class="px-5 py-3">Pengguna</th>
                                <th class="px-5 py-3">Role</th>
                                <th class="px-5 py-3">Terdaftar</th>
                                <th class="px-5 py-3">2FA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($recentUsers as $user)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-[11px] font-bold text-white
                                            {{ $user->role === 'super_admin' ? 'bg-purple-500' : ($user->role === 'admin' ? 'bg-blue-500' : 'bg-slate-400') }}">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800 dark:text-white leading-tight">{{ $user->name }}</p>
                                            <p class="text-[11px] text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($user->role === 'super_admin')
                                        <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold text-purple-600 bg-purple-500/10 rounded-lg">SUPER ADMIN</span>
                                    @elseif($user->role === 'admin')
                                        <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold text-blue-600 bg-blue-500/10 rounded-lg">ADMIN</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold text-slate-600 bg-slate-100 dark:bg-slate-800 rounded-lg">USER</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-xs text-slate-500">
                                    {{ $user->created_at->locale('id')->diffForHumans() }}
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($user->google2fa_enabled)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-bold text-emerald-600 bg-emerald-500/10 rounded-lg">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 rounded-lg">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-5 py-10 text-center text-sm text-slate-400">
                                    Belum ada pengguna yang disetujui.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Panel Pending Approval --}}
            <div class="card-premium p-5 flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-1 h-5 bg-amber-500 rounded-full"></div>
                    <h3 class="font-bold text-slate-800 dark:text-white">Menunggu Persetujuan</h3>
                    @if($stats['pending_users'] > 0)
                    <span class="ml-auto inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-amber-500 rounded-full">
                        {{ $stats['pending_users'] }}
                    </span>
                    @endif
                </div>

                @if($pendingUsers->isNotEmpty())
                    <div class="space-y-3">
                        @foreach($pendingUsers as $pUser)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-amber-50 dark:bg-amber-500/5 border border-amber-100 dark:border-amber-500/10">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-700 text-[11px] font-bold flex items-center justify-center flex-shrink-0">
                                {{ strtoupper(substr($pUser->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-semibold text-slate-800 dark:text-white truncate">{{ $pUser->name }}</p>
                                <p class="text-[10px] text-slate-500 truncate">{{ $pUser->email }}</p>
                                <p class="text-[10px] text-amber-600 mt-0.5">{{ $pUser->created_at->locale('id')->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if(Auth::user()->role === 'super_admin')
                    <a href="{{ route('admin.approvals') }}"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-amber-500/20 mt-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Proses Semua Approval
                    </a>
                    @endif
                @else
                    <div class="flex flex-col items-center justify-center flex-1 py-8 gap-3 text-center">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">Semua Bersih!</p>
                            <p class="text-xs text-slate-500 mt-0.5">Tidak ada permintaan yang menunggu.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════
             QUICK LINKS — Menu Navigasi Cepat
        ═══════════════════════════════════════════════════ --}}
        <div>
            <div class="flex items-center gap-3 mb-3">
                <h2 class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Akses Cepat</h2>
                <div class="flex-1 h-px bg-slate-200 dark:bg-slate-800"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <a href="/admin/users"
                    class="card-premium p-5 flex flex-col items-center justify-center gap-3 text-center hover:border-blue-500/30 transition-all group">
                    <div class="p-3 bg-blue-500/10 text-blue-600 rounded-xl group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Manajemen User</p>
                </a>

                <a href="/admin/proyektor"
                    class="card-premium p-5 flex flex-col items-center justify-center gap-3 text-center hover:border-indigo-500/30 transition-all group">
                    <div class="p-3 bg-indigo-500/10 text-indigo-600 rounded-xl group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Statistik Proyektor</p>
                </a>

                <a href="/admin/kinexa"
                    class="card-premium p-5 flex flex-col items-center justify-center gap-3 text-center hover:border-emerald-500/30 transition-all group">
                    <div class="p-3 bg-emerald-500/10 text-emerald-600 rounded-xl group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Data Pegawai (Kinexa)</p>
                </a>

                @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('admin.approvals') }}"
                    class="card-premium p-5 flex flex-col items-center justify-center gap-3 text-center hover:border-amber-500/30 transition-all group relative">
                    <div class="p-3 bg-amber-500/10 text-amber-600 rounded-xl group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Approval Pengguna</p>
                    @if($stats['pending_users'] > 0)
                    <span class="absolute top-3 right-3 inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-amber-500 rounded-full">
                        {{ $stats['pending_users'] }}
                    </span>
                    @endif
                </a>
                @else
                <div class="card-premium p-5 flex flex-col items-center justify-center gap-3 text-center opacity-40 cursor-not-allowed">
                    <div class="p-3 bg-slate-500/10 text-slate-500 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">Approval Pengguna</p>
                </div>
                @endif
            </div>
        </div>

    </div>

</x-layouts.admin>

