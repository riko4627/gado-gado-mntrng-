import { ProyektorService } from '../services/proyektorService';

/**
 * ProyektorController.js
 * Handles UI rendering and interactions for the Proyektor statistics page.
 * Also used by the Dashboard to render the proyektor stats section.
 */

// Card definitions for rendering
const CARDS = [
    {
        key: 'total_proyektor',
        label: 'Total Proyektor',
        bg: 'bg-indigo-500/10',
        text: 'text-indigo-600',
        darkText: 'dark:text-indigo-400',
        glow: 'bg-indigo-500/5',
        badge: 'Proyektor',
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>`
    },
    {
        key: 'total_proyektor_rusak',
        label: 'Proyektor Rusak',
        bg: 'bg-rose-500/10',
        text: 'text-rose-600',
        darkText: 'dark:text-rose-400',
        glow: 'bg-rose-500/5',
        badge: 'Rusak',
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>`
    },
    {
        key: 'total_pengguna',
        label: 'Pengguna Proyektor',
        bg: 'bg-cyan-500/10',
        text: 'text-cyan-600',
        darkText: 'dark:text-cyan-400',
        glow: 'bg-cyan-500/5',
        badge: 'Pengguna',
        icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>`
    }
];

export const ProyektorController = {
    // Element IDs — digunakan di halaman proyektor maupun dashboard
    gridId: 'proyektor-grid',
    statusId: 'proyektor-status',
    refreshBtnId: 'refresh-stats',
    refreshIconId: 'refresh-icon',
    errorId: 'error-message',

    init() {
        const refreshBtn = document.getElementById(this.refreshBtnId);

        // Hanya jalankan init jika elemen grid ada di halaman ini
        if (!document.getElementById(this.gridId)) return;

        this.fetch();

        refreshBtn?.addEventListener('click', () => this.fetch());
    },

    async fetch() {
        const grid     = document.getElementById(this.gridId);
        const status   = document.getElementById(this.statusId);
        const icon     = document.getElementById(this.refreshIconId);
        const errorEl  = document.getElementById(this.errorId);
        const refreshBtn = document.getElementById(this.refreshBtnId);

        if (!grid) return;

        // Reset state
        icon?.classList.add('animate-spin');
        if (refreshBtn) refreshBtn.disabled = true;
        errorEl?.classList.add('hidden');

        this._setStatus(status, 'loading');
        this._renderSkeleton(grid);

        try {
            const data = await ProyektorService.getStats();
            this._renderCards(grid, data);
            this._setStatus(status, 'online');
        } catch (error) {
            console.error('[ProyektorController] fetch error:', error);
            this._renderError(grid, error.message);
            this._setStatus(status, 'error');
        } finally {
            icon?.classList.remove('animate-spin');
            if (refreshBtn) refreshBtn.disabled = false;
        }
    },

    // ─── Private Render Helpers ──────────────────────────────────────────────

    _renderSkeleton(grid) {
        grid.innerHTML = Array(3).fill(0).map(() => `
            <div class="card-premium p-6 animate-pulse">
                <div class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-3 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-3"></div>
                <div class="h-8 w-16 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
        `).join('');
    },

    _renderCards(grid, data) {
        grid.innerHTML = CARDS.map(card => `
            <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                <div class="flex items-center justify-between relative z-10">
                    <div class="p-2.5 ${card.bg} ${card.text} ${card.darkText} rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${card.icon}
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold ${card.text} ${card.bg} px-2 py-0.5 rounded-full">
                        ${card.badge}
                    </span>
                </div>
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">${card.label}</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">
                        ${(data[card.key] ?? 0).toLocaleString('id-ID')}
                    </h3>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 ${card.glow} rounded-full blur-2xl group-hover:opacity-150 transition-colors"></div>
            </div>
        `).join('');
    },

    _renderError(grid, message = '') {
        const colSpan = grid.className.includes('sm:grid-cols-3') ? 'sm:col-span-3' : '';
        grid.innerHTML = `
            <div class="${colSpan} card-premium p-6 flex items-center gap-4 border-rose-500/20 bg-rose-500/5">
                <div class="p-3 bg-rose-500/10 text-rose-600 rounded-xl flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-rose-600">Gagal Memuat Data Proyektor</p>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Sistem proyektor mungkin sedang offline.
                        <button id="retry-proyektor" class="text-blue-600 underline hover:no-underline">Coba lagi</button>
                    </p>
                    ${message ? `<p class="text-[10px] text-slate-400 mt-1">${message}</p>` : ''}
                </div>
            </div>
        `;

        document.getElementById('retry-proyektor')?.addEventListener('click', () => this.fetch());
    },

    _setStatus(el, state) {
        if (!el) return;
        const states = {
            loading: {
                html: `<span class="w-2 h-2 rounded-full bg-slate-300 animate-pulse"></span> Memuat...`,
                cls: 'flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400'
            },
            online: {
                html: `<span class="w-2 h-2 rounded-full bg-emerald-500"></span> Terhubung`,
                cls: 'flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-emerald-600'
            },
            error: {
                html: `<span class="w-2 h-2 rounded-full bg-rose-500"></span> Offline`,
                cls: 'flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-rose-500'
            }
        };
        const s = states[state] ?? states.loading;
        el.innerHTML = s.html;
        el.className = s.cls;
    }
};
