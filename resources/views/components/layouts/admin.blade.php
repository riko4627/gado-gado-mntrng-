<x-layouts.app>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm hidden lg:hidden"></div>

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full overflow-y-auto bg-bg-main text-text-main">
            <!-- Navbar -->
            <x-navbar />

            <!-- Page Content -->
            <main class="flex-1 p-4 lg:p-8">
                <div class="max-w-7xl mx-auto animate-fade-in">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="p-6 text-center text-sm text-slate-500 border-t border-slate-200 dark:border-slate-800">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Ka_Tri | IT_Center.
            </footer>
        </div>
    </div>

    <!-- ✅ SCRIPT TARUH DI SINI -->
    <script>
        function toggleMonitoring() {
            const menu = document.getElementById('menu-monitoring');
            const icon = document.getElementById('icon-monitoring');

            if (menu && icon) {
                menu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }
        }

        async function checkStatus() {
            const proyektor = document.getElementById('status-proyektor');
            const kinexa = document.getElementById('status-kinexa');

            // kalau element tidak ada, skip (biar aman)
            if (!proyektor || !kinexa) return;

            // PROYEKTOR
            try {
                const res = await fetch('https://proyektor.uwn.ac.id/api/stats');
                if (res.ok) {
                    proyektor.className = 'text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400';
                } else throw new Error();
            } catch {
                proyektor.className = 'text-[10px] px-2 py-0.5 rounded-full bg-rose-500/10 text-rose-400';
            }

            // KINEXA
            try {
                const res = await fetch('/admin/kinexa/summary');
                const json = await res.json();

                if (json.status === 'success') {
                    kinexa.className = 'text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400';
                } else throw new Error();
            } catch {
                kinexa.className = 'text-[10px] px-2 py-0.5 rounded-full bg-rose-500/10 text-rose-400';
            }
        }

        document.addEventListener('DOMContentLoaded', checkStatus);
    </script>

</x-layouts.app>
