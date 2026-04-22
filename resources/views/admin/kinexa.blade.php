<x-layouts.admin>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-blue-50 lg:text-3xl">Statistik Pegawai (Kinexa)</h1>
                <p class="text-slate-600 dark:text-slate-400">Data ringkasan pegawai dari sistem Kinexa terintegrasi.</p>
            </div>
            <div class="flex items-center gap-3">
                <div id="kinexa-status" class="flex items-center gap-2 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-500 rounded-full transition-all">
                    <span class="w-2 h-2 rounded-full bg-slate-400 animate-pulse"></span>
                    Menghubungkan...
                </div>
                <button id="refresh-kinexa" class="p-2 text-slate-600 dark:text-slate-400 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
                    <svg id="refresh-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" id="kinexa-stats-container">
            <!-- Skeleton items -->
            <div class="card-premium p-6 animate-pulse">
                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-4 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-2"></div>
                <div class="h-8 w-16 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
            <div class="card-premium p-6 animate-pulse">
                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-4 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-2"></div>
                <div class="h-8 w-16 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
        </div>

        <!-- Error State (Hidden) -->
        <div id="kinexa-error" class="hidden">
            <div class="card-premium p-8 flex flex-col items-center text-center gap-4 border-rose-500/20 bg-rose-500/5">
                <div class="w-16 h-16 bg-rose-500/10 text-rose-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-rose-600">Terjadi Kesalahan</h3>
                    <p id="error-text" class="text-sm text-slate-600 dark:text-slate-400 max-w-md">Gagal mengambil data dari API Kinexa. Silakan periksa koneksi atau kredensial API Anda.</p>
                </div>
                <button onclick="fetchKinexaData()" class="px-6 py-2 bg-rose-600 text-white rounded-xl hover:bg-rose-700 transition-all font-bold shadow-lg shadow-rose-600/20">Coba Lagi</button>
            </div>
        </div>
    </div>
</x-layouts.admin>

