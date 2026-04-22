<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-sidebar-bg text-sidebar-text transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 shadow-2xl lg:shadow-none">

    <div class="flex flex-col h-full">

        <!-- LOGO -->
        <div class="flex items-center justify-between h-16 px-6 bg-primary-light/30 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="p-1.5 bg-white rounded-lg shadow-lg">
                    <img src="{{ asset('assets/img/LOGO UWN.png') }}" class="w-6 h-6">
                </div>
                <span class="text-lg font-bold">UWN</span>
            </div>

            <button class="p-1 lg:hidden text-white/50 hover:text-white" id="sidebar-close-btn">
                ✕
            </button>
        </div>

        <!-- NAVIGATION -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            <!-- UTAMA -->
            <p class="px-4 mb-2 text-[10px] uppercase font-bold text-white/40 tracking-widest">Utama</p>

            <a href="/admin" class="sidebar-link {{ request()->is('admin') ? 'active' : '' }}">
                🏠 Dashboard
            </a>

            <a href="/admin/users" class="sidebar-link {{ request()->is('admin/users') ? 'active' : '' }}">
                👥 Pengguna
            </a>

            @if (auth()->check() && auth()->user()->role === 'super_admin')
                @php
                    $pendingCount = \App\Models\User::where('status', 'pending')->count();
                @endphp
                <a href="{{ route('admin.approvals') }}"
                    class="sidebar-link flex items-center justify-between {{ request()->is('admin/approvals') ? 'active' : '' }}">
                    <span>🛡️ Persetujuan</span>
                    @if ($pendingCount > 0)
                        <span
                            class="inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold text-white bg-amber-500 rounded-full animate-pulse">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>
            @endif


            <!-- MONITORING -->
            <div class="pt-4 mt-4 border-t border-white/5">

                <button onclick="toggleMonitoring()"
                    class="w-full flex items-center justify-between px-4 py-2 text-[10px] uppercase font-bold text-white/40 tracking-widest hover:text-white">

                    Monitoring Sistem

                    <span id="icon-monitoring">▼</span>
                </button>

                <div id="menu-monitoring" class="mt-2 space-y-1 hidden">

                    <!-- PROYEKTOR -->
                    <a href="/admin/proyektor"
                        class="sidebar-link flex justify-between {{ request()->is('admin/proyektor') ? 'active' : '' }}">
                        <span>🖥️ Proyektor</span>
                        <span id="status-proyektor"
                            class="text-[10px] px-2 py-0.5 rounded-full bg-slate-500/10 text-slate-400">
                            ●
                        </span>
                    </a>

                    <!-- KINEXA -->
                    <a href="/admin/kinexa"
                        class="sidebar-link flex justify-between {{ request()->is('admin/kinexa') ? 'active' : '' }}">
                        <span>👨‍💼 Kinexa</span>
                        <span id="status-kinexa"
                            class="text-[10px] px-2 py-0.5 rounded-full bg-slate-500/10 text-slate-400">
                            ●
                        </span>
                    </a>

                </div>
            </div>


            <!-- PENGATURAN -->
            <div class="pt-4 mt-4 border-t border-white/5">
                <p class="px-4 mb-2 text-[10px] uppercase font-bold text-white/40 tracking-widest">Pengaturan</p>

                <a href="/2fa/setup" class="sidebar-link {{ request()->is('2fa/setup') ? 'active' : '' }}">
                    🔐 2FA {{ auth()->user()->google2fa_enabled ? '(Aktif)' : '(Setup)' }}
                </a>

                <a href="#" class="sidebar-link">
                    ⚙️ Sistem
                </a>
            </div>

        </nav>


        <!-- FOOTER -->
        <div class="p-4 mt-auto border-t border-white/5">
            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                <div
                    class="w-8 h-8 bg-blue-500/20 flex items-center justify-center text-blue-400 text-xs font-bold rounded-full flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-xs font-semibold truncate">{{ auth()->user()->name ?? 'Pengguna' }}</div>
                    <div class="text-[10px] text-white/50 capitalize">{{ auth()->user()->role ?? 'user' }}</div>
                </div>
            </div>
        </div>

    </div>
</aside>
