<x-layouts.app>
    <div
        class="relative min-h-screen flex items-center justify-center bg-slate-50 dark:bg-slate-950 overflow-hidden transition-colors duration-300">
        <!-- Abstract Background Blobs -->
        <div
            class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-500/10 rounded-full blur-[120px] -z-10 animate-pulse">
        </div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-500/10 rounded-full blur-[120px] -z-10 animate-pulse"
            style="animation-delay: 2s;"></div>

        <div class="w-full max-w-md p-4 animate-fade-in">
            <!-- Glassmorphism Card -->
            <div
                class="glass relative p-8 md:p-10 rounded-[2.5rem] shadow-2xl shadow-blue-500/5 border border-white/20 dark:border-white/5 backdrop-blur-xl bg-white/40 dark:bg-slate-900/40">

                <!-- Branding -->
                <div class="flex flex-col items-center mb-10">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center shadow-xl mb-6 p-2">
                        <img src="{{ asset('assets/img/LOGO UWN.png') }}" class="w-full h-full object-contain">
                    </div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        PORTAL<span class="text-blue-600">XxX</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm font-medium">Monitoring System</p>
                </div>

                <div class="space-y-6">
                    <div class="text-center">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Selamat Datang Kembali</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Silahkan masuk menggunakan akun
                            Google Anda</p>
                    </div>

                    <!-- Auth Error Notification (Optional) -->
                    @if (request()->get('error'))
                        <div
                            class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center gap-3 text-rose-600 animate-shake">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xs font-semibold">Autentikasi gagal. Silahkan coba lagi.</p>
                        </div>
                    @endif

                    <!-- Google Login Button -->
                    <button id="btn-google-login"
                        class="w-full group relative flex items-center justify-center gap-3 px-6 py-4 bg-white dark:bg-slate-800 text-slate-700 dark:text-white font-bold rounded-2xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-slate-200/50 dark:shadow-none">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        <span>Masuk dengan Google</span>

                        <!-- Hover Glow Effect -->
                        <div
                            class="absolute inset-0 rounded-2xl bg-blue-500/0 group-hover:bg-blue-500/5 transition-colors">
                        </div>
                    </button>

                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200 dark:border-slate-800"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase"><span
                                class="bg-white dark:bg-slate-900 px-2 text-slate-400 font-medium">Atau</span></div>
                    </div>

                    <p class="text-center text-xs text-slate-500 dark:text-slate-400">
                        Pastikan Anda menggunakan email institusi yang terdaftar untuk akses penuh ke sistem monitoring.
                    </p>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-8 flex justify-center gap-6 text-xs font-semibold text-slate-400 dark:text-slate-500">
                <a href="/" class="hover:text-blue-600 transition-colors">Beranda</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Bantuan</a>
            </div>
        </div>
    </div>
</x-layouts.app>
