import { AuthService } from '../services/authService';

/**
 * AuthController.js
 * Handles UI logic for Login page.
 */

export const AuthController = {
    loginBtn: null,
    logoutBtn: null,
    
    init() {
        this.cacheDOM();
        this.bindEvents();
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
    }
};
