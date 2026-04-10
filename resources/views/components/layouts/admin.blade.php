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
                &copy; {{ date('Y') }} {{ config('app.name') }}. Built with ❤️ for Admin.
            </footer>
        </div>
    </div>
</x-layouts.app>
