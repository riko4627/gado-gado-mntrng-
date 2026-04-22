import { KinexaService } from '../services/kinexaService';

/**
 * KinexaController.js
 * Handles UI rendering and interactions for the Kinexa Pegawai statistics page.
 */

// Color schemes untuk card dinamis
const COLOR_SCHEMES = [
    { bg: 'bg-blue-500/10',    text: 'text-blue-600',    glow: 'bg-blue-500/5'    },
    { bg: 'bg-emerald-500/10', text: 'text-emerald-600', glow: 'bg-emerald-500/5' },
    { bg: 'bg-amber-500/10',   text: 'text-amber-600',   glow: 'bg-amber-500/5'   },
    { bg: 'bg-purple-500/10',  text: 'text-purple-600',  glow: 'bg-purple-500/5'  },
    { bg: 'bg-rose-500/10',    text: 'text-rose-600',    glow: 'bg-rose-500/5'    },
    { bg: 'bg-indigo-500/10',  text: 'text-indigo-600',  glow: 'bg-indigo-500/5'  },
];

export const KinexaController = {
    // Element IDs — sesuaikan dengan yang ada di blade
    containerId: 'kinexa-stats-container',
    statusId: 'kinexa-status',
    refreshBtnId: 'refresh-kinexa',
    refreshIconId: 'refresh-icon',
    errorId: 'kinexa-error',
    errorTextId: 'error-text',

    init() {
        // Hanya jalankan jika container ada di halaman ini
        if (!document.getElementById(this.containerId)) return;

        this.fetch();

        document.getElementById(this.refreshBtnId)
            ?.addEventListener('click', () => this.fetch());
    },

    async fetch() {
        const container = document.getElementById(this.containerId);
        const errorEl   = document.getElementById(this.errorId);
        const icon      = document.getElementById(this.refreshIconId);
        const status    = document.getElementById(this.statusId);

        if (!container) return;

        // Reset state
        icon?.classList.add('animate-spin');
        errorEl?.classList.add('hidden');
        container.classList.remove('hidden');
        this._setStatus(status, 'loading');
        this._renderSkeleton(container);

        try {
            const data = await KinexaService.getSummary();
            this._renderCards(container, data);
            this._setStatus(status, 'online');
        } catch (error) {
            console.error('[KinexaController] fetch error:', error);
            const errorTextEl = document.getElementById(this.errorTextId);
            if (errorTextEl) errorTextEl.textContent = error.message;
            errorEl?.classList.remove('hidden');
            container.classList.add('hidden');
            this._setStatus(status, 'error');
        } finally {
            icon?.classList.remove('animate-spin');
        }
    },

    // ─── Private Render Helpers ──────────────────────────────────────────────

    _renderSkeleton(container, count = 4) {
        container.innerHTML = Array(count).fill(0).map(() => `
            <div class="card-premium p-6 animate-pulse">
                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-800 rounded-xl mb-4"></div>
                <div class="h-4 w-24 bg-slate-100 dark:bg-slate-800 rounded mb-2"></div>
                <div class="h-8 w-16 bg-slate-100 dark:bg-slate-800 rounded"></div>
            </div>
        `).join('');
    },

    _renderCards(container, data) {
        const entries = Object.entries(data);

        if (!entries.length) {
            container.innerHTML = `
                <div class="col-span-4 card-premium p-8 text-center text-slate-400">
                    <p class="text-sm">Tidak ada data yang tersedia dari Kinexa.</p>
                </div>
            `;
            return;
        }

        container.innerHTML = entries.map(([key, value], index) => {
            const scheme = COLOR_SCHEMES[index % COLOR_SCHEMES.length];
            const label  = key.replace(/_/g, ' ')
                             .replace(/\b\w/g, c => c.toUpperCase()); // Title Case

            const displayValue = typeof value === 'number'
                ? value.toLocaleString('id-ID')
                : value;

            return `
                <div class="card-premium p-6 flex flex-col gap-4 relative overflow-hidden group">
                    <div class="flex items-center justify-between relative z-10">
                        <div class="p-3 ${scheme.bg} ${scheme.text} rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-400">${label}</p>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white">${displayValue}</h3>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 ${scheme.glow} rounded-full blur-2xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
                </div>
            `;
        }).join('');
    },

    _setStatus(el, state) {
        if (!el) return;
        const states = {
            loading: {
                html: `<span class="w-2 h-2 rounded-full bg-slate-400 animate-pulse"></span> Menghubungkan...`,
                cls: 'flex items-center gap-2 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-500 rounded-full transition-all'
            },
            online: {
                html: `<span class="w-2 h-2 rounded-full bg-emerald-500"></span> Terhubung`,
                cls: 'flex items-center gap-2 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-600 rounded-full transition-all'
            },
            error: {
                html: `<span class="w-2 h-2 rounded-full bg-rose-500"></span> Error`,
                cls: 'flex items-center gap-2 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider bg-rose-500/10 text-rose-600 rounded-full transition-all'
            }
        };
        const s = states[state] ?? states.loading;
        el.innerHTML = s.html;
        el.className = s.cls;
    }
};
