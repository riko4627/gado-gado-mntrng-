/**
 * ProyektorService.js
 * Handles all API calls related to Proyektor statistics.
 * Fetches data from the external proyektor.uwn.ac.id API.
 */

export const ProyektorService = {
    API_URL: 'https://proyektor.uwn.ac.id/api/stats',

    /**
     * Fetch proyektor statistics from the external API.
     * @returns {Promise<{total_proyektor, total_proyektor_rusak, total_pengguna}>}
     */
    async getStats() {
        const response = await fetch(this.API_URL);

        if (!response.ok) {
            throw new Error(`API responded with status ${response.status}`);
        }

        const json = await response.json();
        return json.data ?? {};
    }
};
