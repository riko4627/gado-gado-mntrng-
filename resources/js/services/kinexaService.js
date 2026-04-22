/**
 * KinexaService.js
 * Handles all API calls related to Kinexa Pegawai statistics.
 * Fetches data through the Laravel backend proxy endpoint.
 */

export const KinexaService = {
    SUMMARY_URL: '/admin/kinexa/summary',

    /**
     * Fetch pegawai summary data from the backend proxy.
     * The backend handles token acquisition and caching.
     * @returns {Promise<{status: string, data?: object, message?: string}>}
     */
    async getSummary() {
        const response = await fetch(this.SUMMARY_URL);

        if (!response.ok) {
            throw new Error(`Server responded with status ${response.status}`);
        }

        const result = await response.json();

        if (result.status === 'error') {
            throw new Error(result.message ?? 'Gagal mengambil data dari Kinexa');
        }

        return result.data ?? {};
    }
};
