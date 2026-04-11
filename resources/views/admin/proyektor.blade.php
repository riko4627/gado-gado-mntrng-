<x-layouts.admin>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-blue-50 lg:text-3xl">Statistik
                    Proyektor</h1>
                <p class="text-slate-600 dark:text-slate-400">Data real-time dari sistem proyektor terintegrasi.</p>
            </div>

            <div class="flex items-center gap-3">
                <div id="proyektor-status"
                    class="flex items-center gap-2 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-500 rounded-full transition-all">
                    <span class="w-2 h-2 rounded-full bg-slate-400 animate-pulse"></span>
                    Menghubungkan...
                </div>
                <button id="refresh-stats"
                    class="p-2 text-slate-600 dark:text-slate-400 bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all shadow-sm">
                    <svg id="refresh-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </button>
            </div>

        </div>


        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3" id="stats-container">
            <!-- Loading Skeleton - First Card -->
            <div id="card1" class="card-premium p-6 animate-pulse">
                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-4 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-3"></div>
                <div class="h-8 w-20 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
            <!-- Loading Skeleton - Second Card -->
            <div id="card2" class="card-premium p-6 animate-pulse">
                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-4 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-3"></div>
                <div class="h-8 w-20 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
            <!-- Loading Skeleton - Third Card -->
            <div id="card3" class="card-premium p-6 animate-pulse">
                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-4 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-3"></div>
                <div class="h-8 w-20 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>


            <!-- Proyektor Rusak -->
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-3 bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Proyektor Rusak</p>
                    <h3 id="total_proyektor_rusak"
                        class="text-3xl font-bold text-slate-900 dark:text-white transition-all">...</h3>
                </div>
                <div
                    class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl group-hover:bg-rose-500/10 transition-colors">
                </div>
            </div>

            <!-- Total Pengguna -->
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-3 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Pengguna</p>
                    <h3 id="total_pengguna" class="text-3xl font-bold text-slate-900 dark:text-white transition-all">...
                    </h3>
                </div>
                <div
                    class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-colors">
                </div>
            </div>
        </div>

        <!-- Error Message (Hidden by default) -->
        <div id="error-message" class="hidden animate-fade-in">
            <div
                class="bg-rose-500/10 border border-rose-500/20 rounded-2xl p-6 flex flex-col items-center text-center gap-3">
                <div class="p-3 bg-rose-500/10 text-rose-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-rose-600">Gagal Memuat Data</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Terjadi kesalahan saat mengambil statistik
                        dari API. Pastikan sistem proyektor sedang online.</p>
                </div>
                <button onclick="fetchProjectorStats()"
                    class="px-4 py-2 bg-rose-600 text-white rounded-xl hover:bg-rose-700 transition-all font-medium text-sm">Coba
                    Lagi</button>
            </div>
        </div>
    </div>

    <script>
        async function fetchProjectorStats() {
            const elements = {
                total_proyektor: document.getElementById('total_proyektor'),
                total_proyektor_rusak: document.getElementById('total_proyektor_rusak'),
                total_pengguna: document.getElementById('total_pengguna')
            };
            const refreshBtn = document.getElementById('refresh-stats');
            const refreshIcon = document.getElementById('refresh-icon');
            const errorMessage = document.getElementById('error-message');
            const statsContainer = document.getElementById('stats-container');

            // Reset states
            errorMessage.classList.add('hidden');
            statsContainer.classList.remove('opacity-50');
            refreshIcon.classList.add('animate-spin');
            refreshBtn.disabled = true;

            // Set loading state
            Object.values(elements).forEach(el => el.textContent = '...');

            try {
                // Fetch from external API
                const response = await fetch('https://proyektor.uwn.ac.id/api/stats');

                if (!response.ok) throw new Error('Network response was not ok');

                const json = await response.json();
                const data = json.data;

                // Update UI with real data
                elements.total_proyektor.textContent = (data.total_proyektor ?? 0).toLocaleString();
                elements.total_proyektor_rusak.textContent = (data.total_proyektor_rusak ?? 0).toLocaleString();
                elements.total_pengguna.textContent = (data.total_pengguna ?? 0).toLocaleString();

            } catch (error) {
                console.error('Fetch error:', error);
                errorMessage.classList.remove('hidden');
                statsContainer.classList.add('opacity-50');
                Object.values(elements).forEach(el => el.textContent = '!');
            } finally {
                refreshIcon.classList.remove('animate-spin');
                refreshBtn.disabled = false;
            }
        }

        document.getElementById('refresh-stats').addEventListener('click', fetchProjectorStats);

        // Initial fetch on page load
        document.addEventListener('DOMContentLoaded', fetchProjectorStats);
    </script>
</x-layouts.admin>
