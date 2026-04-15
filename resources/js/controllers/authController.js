import { AuthService } from '../services/authService';

/**
 * AuthController.js
 * Handles UI logic for Login and Auth Callback pages.
 */

export const AuthController = {
    loginBtn: null,
    logoutBtn: null,
    
    init() {
        this.cacheDOM();
        this.bindEvents();
        this.handleCallbackPage();
    },

    cacheDOM() {
        this.loginBtn = document.getElementById('btn-google-login');
        this.logoutBtn = document.getElementById('btn-logout');
    },

    bindEvents() {
        if (this.loginBtn) {
            this.loginBtn.addEventListener('click', (e) => {
                e.preventDefault();
                AuthService.googleLoginRedirect();
            });
        }

        if (this.logoutBtn) {
            this.logoutBtn.addEventListener('click', (e) => {
                e.preventDefault();
                AuthService.logout();
            });
        }
    },

    /**
     * If the current page is the callback page, process the token.
     */
    handleCallbackPage() {
        if (window.location.pathname === '/auth/callback') {
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
            const error = urlParams.get('error');

            if (token) {
                const success = AuthService.handleToken(token);
                if (success) {
                    // Redirect to dashboard on success
                    window.location.href = '/admin';
                }
            } else if (error) {
                console.error('Auth Error:', error);
                window.location.href = '/login?error=' + error;
            }
        }
    }
};
