/**
 * AuthService.js
 * Handles authentication logic, tokens, and Google OAuth redirection.
 */

export const AuthService = {
    /**
     * Redirect user to the Google OAuth endpoint.
     */
    googleLoginRedirect() {
        window.location.href = '/v1/auth/google';
    },

    /**
     * Store the Sanctum token securely in localStorage.
     * @param {string} token 
     */
    handleToken(token) {
        if (token) {
            localStorage.setItem('auth_token', token);
            return true;
        }
        return false;
    },

    /**
     * Retrieve the stored token.
     */
    getToken() {
        return localStorage.getItem('auth_token');
    },

    /**
     * Remove the token and logout.
     */
    async logout() {
        try {
            const token = this.getToken();
            if (token) {
                // Beritahu backend untuk mencabut token
                await fetch('/v1/auth/logout', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
            }
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        }
    },

    /**
     * Check if user is authenticated.
     */
    isAuthenticated() {
        return !!this.getToken();
    }
};
