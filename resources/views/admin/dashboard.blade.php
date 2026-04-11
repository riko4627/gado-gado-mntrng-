<x-layouts.admin>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-blue-50 lg:text-3xl">Dashboard Overview</h1>
                <p class="text-slate-600 dark:text-slate-400">Ringkasan aktivitas dan performa sistem Anda.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2 text-sm font-medium bg-white dark:bg-surface-dark border border-slate-200 dark:border-slate-800 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Ekspor Data
                </button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all">
                    Tambah Laporan
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Stat Card 1 -->
            <div class="card-premium p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="p-2 bg-blue-500/10 text-blue-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-full">+12%</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Pengguna</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">1,284</h3>
                </div>
            </div>

            <!-- Stat Card 2 -->
            <div class="card-premium p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="p-2 bg-emerald-500/10 text-emerald-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-full">+5%</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Laporan Selesai</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">856</h3>
                </div>
            </div>

            <!-- Stat Card 3 -->
            <div class="card-premium p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="p-2 bg-amber-500/10 text-amber-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-full">Pending</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Menunggu Verifikasi</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">42</h3>
                </div>
            </div>

            <!-- Stat Card 4 -->
            <div class="card-premium p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div class="p-2 bg-rose-500/10 text-rose-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-rose-500 bg-rose-500/10 px-2 py-0.5 rounded-full">-3%</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Laporan Ditolak</p>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">18</h3>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Table Section -->
            <div class="lg:col-span-2 card-premium overflow-hidden">
                <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-bold">Laporan Terbaru</h3>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300 uppercase text-[10px] font-bold">
                            <tr>
                                <th class="px-6 py-4">ID</th>
                                <th class="px-6 py-4">Pelapor</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">#TR-2024-001</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center text-[10px] font-bold">JD</div>
                                        <span class="text-sm">John Doe</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">Infrastruktur</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-1 text-[10px] font-bold text-amber-600 bg-amber-500/10 rounded-lg">PROSES</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-1 text-slate-400 hover:text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">#TR-2024-002</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center text-[10px] font-bold">AS</div>
                                        <span class="text-sm">Alice Smith</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">Keamanan</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-500/10 rounded-lg">SELESAI</span>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-1 text-slate-400 hover:text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Side Card Section -->
            <div class="card-premium p-6">
                <h3 class="font-bold mb-4">Aktivitas Sistem</h3>
                <div class="relative space-y-6 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100 dark:before:bg-slate-800">
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-blue-500 border-4 border-white dark:border-surface-dark shadow-sm"></div>
                        <p class="text-xs font-bold text-slate-900 dark:text-white">Admin Memperbarui Pengaturan</p>
                        <p class="text-[10px] text-slate-500">Baru saja</p>
                    </div>
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-amber-500 border-4 border-white dark:border-surface-dark shadow-sm"></div>
                        <p class="text-xs font-bold text-slate-900 dark:text-white">Laporan Baru Masuk #TR-2024-001</p>
                        <p class="text-[10px] text-slate-500">2 menit yang lalu</p>
                    </div>
                    <div class="relative pl-8">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-emerald-500 border-4 border-white dark:border-surface-dark shadow-sm"></div>
                        <p class="text-xs font-bold text-slate-900 dark:text-white">User Berhasil Logout</p>
                        <p class="text-[10px] text-slate-500">1 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layouts.admin>
