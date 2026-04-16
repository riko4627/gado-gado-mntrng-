<x-layouts.app>
    <div class="min-h-screen flex flex-col items-center justify-center bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
        <!-- Animated Loader -->
        <div class="relative">
            <div class="w-16 h-16 border-4 border-blue-500/20 border-t-blue-600 rounded-full animate-spin"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-2 h-2 bg-blue-600 rounded-full animate-ping"></div>
            </div>
        </div>

        <div class="mt-8 text-center animate-pulse">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Menghubungkan Akun...</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">Mohon tunggu sebentar, kami sedang memverifikasi identitas Anda.</p>
        </div>

        <!-- Glass decoration -->
        <div class="fixed bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-500/5 rounded-full blur-[100px] -z-10"></div>
    </div>

    @push('scripts')
    <script>
        // Callback logic is already handled by AuthController.init() in app.js
        // If AuthController.init() is not triggered, this script acts as a fallback or signal
        console.log('Auth Callback Page Loaded');
    </script>
    @endpush
</x-layouts.app>
