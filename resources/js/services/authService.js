/**
 * AuthService.js
 * Handles authentication logic and Google OAuth redirection.
 * Menggunakan session-based auth (bukan token), sesuai dengan backend Laravel.
 */

export const AuthService = {
    /**
     * Redirect user to the Google OAuth endpoint.
     */
    googleLoginRedirect() {
        window.location.href = '/v1/auth/google';
    },

    /**
     * Logout user dengan mengirim POST request ke backend
     * agar session Laravel dihancurkan dengan benar.
     */
    async logout() {
        try {
            // Ambil CSRF token dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            await fetch('/v1/auth/logout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            // Selalu redirect ke login, baik request berhasil maupun gagal
            window.location.href = '/login';
        }
    },

    /**
     * Check if user is authenticated (berdasarkan keberadaan session cookie).
     * Karena kita pakai session-based auth, cukup cek via fetch ke endpoint yang protected.
     * Untuk keperluan sederhana, kita bisa cek keberadaan elemen DOM yang hanya ada saat login.
     */
    isAuthenticated() {
        // Cek berdasarkan elemen DOM (misal tombol logout yang hanya ada saat login)
        return !!document.getElementById('btn-logout');
    }
};
