<x-layouts.admin>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-blue-50 lg:text-3xl">
                    Statistik Proyektor
                </h1>
                <p class="text-slate-600 dark:text-slate-400">Data real-time dari sistem proyektor terintegrasi.</p>
            </div>
            <div class="flex items-center gap-3">
                <button id="refresh-stats"
                    class="px-4 py-2 text-sm font-medium bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors flex items-center gap-2">
                    <svg id="refresh-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Segarkan Data
                </button>
            </div>
        </div>

        {{-- Grid ini akan diisi sepenuhnya oleh ProyektorController.js --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3" id="proyektor-grid"></div>

        {{-- Error Message — dikelola oleh ProyektorController.js --}}
        <div id="error-message" class="hidden animate-fade-in">
            <div class="bg-rose-500/10 border border-rose-500/20 rounded-2xl p-6 flex flex-col items-center text-center gap-3">
                <div class="p-3 bg-rose-500/10 text-rose-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-rose-600">Gagal Memuat Data</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        Terjadi kesalahan saat mengambil statistik dari API. Pastikan sistem proyektor sedang online.
                    </p>
                </div>
                <button id="retry-proyektor-fallback"
                    class="px-4 py-2 bg-rose-600 text-white rounded-xl hover:bg-rose-700 transition-all font-medium text-sm">
                    Coba Lagi
                </button>
            </div>
        </div>
    </div>
</x-layouts.admin>
