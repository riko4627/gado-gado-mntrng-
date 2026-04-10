<x-layouts.app>
    <div
        class="relative min-h-screen bg-slate-50 dark:bg-background-dark text-slate-900 dark:text-white transition-colors duration-300">
        <!-- Floating Navigation -->
        <nav
            class="fixed top-6 left-1/2 -translate-x-1/2 z-50 w-[90%] max-w-5xl glass rounded-2xl px-6 py-4 flex items-center justify-between shadow-2xl shadow-blue-500/10 border border-white/20">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-tight">PLATFORM<span class="text-blue-600">X</span></span>
            </div>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="#" class="hover:text-blue-600 transition-colors">Beranda</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Fitur</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Harga</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Bantuan</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="/admin"
                    class="px-5 py-2 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20">
                    Mulai Sekarang
                </a>
            </div>
        </nav>

        <!-- Hero Sectionn -->
        <section class="relative pt-40 pb-20 px-6 overflow-hidden">
            <!-- Background Decoration -->
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] bg-gradient-to-b from-blue-500/10 to-transparent -z-10 blur-3xl">
            </div>

            <div class="max-w-6xl mx-auto text-center space-y-8 animate-fade-in">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 text-blue-600 text-xs font-bold border border-blue-500/20">
                    <span class="flex h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Versi 4.0 Sekarang Tersedia
                </div>

                <h1 class="text-4xl md:text-7xl font-extrabold tracking-tight leading-tight">
                    Kelola Semuanya Dengan <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Presisi &
                        Keindahan.</span>
                </h1>

                <p class="max-w-2xl mx-auto text-slate-500 dark:text-slate-400 text-lg md:text-xl">
                    Template Laravel premium dengan mode gelap, desain responsif, dan performa tinggi untuk membangun
                    dashboard impian Anda dalam hitungan detik.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                    <a href="/admin"
                        class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-bold rounded-2xl hover:scale-105 transition-transform shadow-xl shadow-blue-500/25">
                        Lihat Dashboard Admin
                    </a>
                    <button
                        class="w-full sm:w-auto px-8 py-4 glass text-slate-900 dark:text-white font-bold rounded-2xl hover:bg-white/20 transition-all border border-slate-200 dark:border-white/10">
                        Dokumentasi
                    </button>
                </div>

                <!-- Dashboard Mockup -->
                <div class="relative mt-20 p-2 glass rounded-[2.5rem] shadow-3xl border border-white/20 group">
                    <div class="overflow-hidden rounded-[2rem] bg-slate-900 aspect-video relative">
                        <div
                            class="absolute inset-0 bg-blue-600/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="px-6 py-3 bg-white text-blue-600 rounded-full font-bold shadow-2xl">Pratinjau
                                Live</span>
                        </div>
                        <!-- Placeholder for dashboard image -->
                        <div class="flex flex-col p-8 gap-6 opacity-40">
                            <div class="flex justify-between items-center">
                                <div class="w-24 h-4 bg-white/20 rounded"></div>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-white/20"></div>
                                    <div class="w-8 h-8 rounded-full bg-white/20"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="h-32 bg-white/10 rounded-2xl"></div>
                                <div class="h-32 bg-white/10 rounded-2xl"></div>
                                <div class="h-32 bg-white/10 rounded-2xl"></div>
                                <div class="h-32 bg-white/10 rounded-2xl"></div>
                            </div>
                            <div class="h-64 bg-white/5 rounded-2xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats -->
        <section class="py-20 border-t border-slate-200 dark:border-slate-800">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <h4 class="text-3xl md:text-5xl font-black text-blue-600">99%</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-2">Kepuasan User</p>
                    </div>
                    <div>
                        <h4 class="text-3xl md:text-5xl font-black text-blue-600">24/7</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-2">Dukungan Teknis</p>
                    </div>
                    <div>
                        <h4 class="text-3xl md:text-5xl font-black text-blue-600">10k+</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-2">Sistem Terpasang</p>
                    </div>
                    <div>
                        <h4 class="text-3xl md:text-5xl font-black text-blue-600">Low</h4>
                        <p class="text-sm font-semibold text-slate-500 mt-2">Latency Sistem</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-12 border-t border-slate-200 dark:border-slate-800 text-center text-slate-500 text-sm">
            <p>&copy; 2026 PlatformX. All rights reserved.</p>
        </footer>
    </div>
</x-layouts.app>
