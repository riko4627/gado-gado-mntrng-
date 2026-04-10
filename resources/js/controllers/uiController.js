/**
 * UIController.js
 * Handles global UI events like Sidebar and Dark Mode.
 */

export const UIController = {
    init() {
        this.initDarkMode();
        this.initSidebar();
    },

    initDarkMode() {
        const themeBtn = document.getElementById('theme-toggle');
        if (!themeBtn) return;

        // Check for saved theme or system preference
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        themeBtn.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    },

    initSidebar() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const overlay = document.getElementById('sidebar-overlay');

        if (!sidebar || !toggleBtn) return;

        const toggle = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay?.classList.toggle('hidden');
        };

        toggleBtn.addEventListener('click', toggle);
        overlay?.addEventListener('click', toggle);
    }
};
