import { ApiService } from './apiService';

/**
 * UserService.js
 * Handles all API calls related to User management.
 */

export const UserService = {
    async getAll(params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const url = `/v1/user${queryString ? `?${queryString}` : ''}`;
        return await ApiService.get(url);
    },

    async getById(id) {
        return await ApiService.get(`/v1/user/get/${id}`);
    },

    async create(data) {
        return await ApiService.post('/v1/user/create', data);
    },

    async update(id, data) {
        return await ApiService.post(`/v1/user/update/${id}`, data);
    },

    async delete(id) {
        return await ApiService.delete(`/v1/user/delete/${id}`);
    }
};
