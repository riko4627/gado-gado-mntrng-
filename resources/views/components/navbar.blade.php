<nav class="sticky top-0 z-30 flex items-center justify-between w-full h-16 px-6 bg-white dark:bg-background-dark backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
    <div class="flex items-center gap-4">
        <button id="sidebar-toggle" class="p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 lg:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <div class="flex flex-col">
            <h2 class="text-sm font-semibold text-primary dark:text-blue-200 lg:text-base">Dashboard Admin</h2>
            <p class="hidden text-xs text-slate-500 dark:text-slate-400 lg:block">Selamat datang kembali, Admin!</p>
        </div>
    </div>

    <div class="flex items-center gap-2 lg:gap-4">
        <!-- Theme Toggle -->
        <button id="theme-toggle" class="p-2 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary dark:hover:text-blue-400 transition-all duration-200">
            <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 18v1m9-9h1M3 9h1m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </button>

        <!-- Profile Dropdown -->
        <div class="flex items-center gap-3 p-1 pl-4 border-l border-slate-200 dark:border-slate-800">
            <div class="hidden text-right lg:block">
                <p class="text-xs font-semibold text-slate-900 dark:text-white">Admin User</p>
                <p class="text-[10px] text-slate-500 dark:text-slate-400">Super Admin</p>
            </div>
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold ring-2 ring-blue-500/20">
                A
            </div>
        </div>
    </div>
</nav>
