import { UserService } from '../services/userService';

/**
 * UserController.js
 * Handles UI interactions for the User Management page.
 */

export const UserController = {
    modal: null,
    modalContent: null,
    deleteModal: null,
    deleteModalContent: null,
    form: null,
    modalTitle: null,
    submitBtn: null,
    passwordHint: null,
    userToDelete: null,

    // AJAX elements
    tableBody: null,
    paginationContainer: null,
    searchInput: null,
    roleFilter: null,

    // State
    currentPage: 1,
    searchQuery: '',
    roleQuery: '',
    searchTimeout: null,

    init() {
        this.cacheDOM();
        if (!this.form) return;
        this.bindEvents();
    },

    cacheDOM() {
        this.modal = document.getElementById('user-modal');
        this.modalContent = document.getElementById('modal-content');
        this.deleteModal = document.getElementById('delete-modal');
        this.deleteModalContent = document.getElementById('delete-modal-content');
        this.form = document.getElementById('user-form');
        this.modalTitle = document.getElementById('modal-title');
        this.submitBtn = document.getElementById('submit-btn');
        this.passwordHint = document.getElementById('password-hint');

        // AJAX Hooks
        this.tableBody = document.getElementById('user-table-body');
        this.paginationContainer = document.getElementById('pagination-container');
        this.searchInput = document.getElementById('user-search');
        this.roleFilter = document.getElementById('user-role-filter');
    },

    bindEvents() {
        // Search Input (Debounced)
        this.searchInput?.addEventListener('input', (e) => {
            clearTimeout(this.searchTimeout);
            this.searchQuery = e.target.value;
            this.searchTimeout = setTimeout(() => {
                this.currentPage = 1;
                this.fetchUsers();
            }, 500);
        });

        // Role Filter
        this.roleFilter?.addEventListener('change', (e) => {
            this.roleQuery = e.target.value === 'Semua Role' ? '' : e.target.value;
            this.currentPage = 1;
            this.fetchUsers();
        });

        // Pagination Clicks (Delegation)
        this.paginationContainer?.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-page');
            if (btn) {
                this.currentPage = btn.dataset.page;
                this.fetchUsers();
            }
        });

        // Global User Table Actions (delegation)
        document.body.addEventListener('click', (e) => {
            const editBtn = e.target.closest('.btn-edit-user');
            const deleteBtn = e.target.closest('.btn-delete-user');
            const addBtn = e.target.closest('.btn-add-user');

            if (editBtn) this.editUser(editBtn.dataset.id);
            if (deleteBtn) this.openDeleteModal(deleteBtn.dataset.id, deleteBtn.dataset.name);
            if (addBtn) this.openModal();
        });

        // Form Submission
        this.form.addEventListener('submit', (e) => this.handleFormSubmit(e));

        // Delete Confirmation
        document.getElementById('delete-confirm-btn')?.addEventListener('click', () => this.handleDelete());

        // Close Buttons
        document.body.addEventListener('click', (e) => {
            if (e.target.closest('.btn-close-modal')) this.closeModal();
            if (e.target.closest('.btn-close-delete-modal')) this.closeDeleteModal();
        });
    },

    async fetchUsers() {
        console.log('UserController: fetchUsers called');
        // Optional: show loading state
        this.tableBody.style.opacity = '0.5';

        try {
            const params = {
                search: this.searchQuery,
                role: this.roleQuery,
                page: this.currentPage
            };

            const result = await UserService.getAll(params);
            console.log('UserController: UserService.getAll result', result);

            if (result.code === 200) {
                this.renderTable(result.data.data);
                this.renderPagination(result.data);
                console.log('UserController: Table and pagination rendered');
            }
        } catch (error) {
            console.error('UserController: FetchUsers Error:', error);
            this.showToast('Gagal memuat data', 'error');
        } finally {
            this.tableBody.style.opacity = '1';
        }
    },

    renderTable(users) {
        if (!users.length) {
            this.tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                        Tidak ada data pengguna ditemukan.
                    </td>
                </tr>
            `;
            return;
        }

        const colors = ['blue', 'purple', 'emerald', 'orange', 'rose', 'amber'];

        this.tableBody.innerHTML = users.map(user => {
            const userIdStr = String(user.id);
            const charCodeSum = userIdStr.split('').reduce((acc, char) => acc + char.charCodeAt(0), 0);
            const color = colors[charCodeSum % colors.length];
            const initial = user.name.charAt(0).toUpperCase();

            return `
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-${color}-100 dark:bg-${color}-900/30 text-${color}-600 flex items-center justify-center font-bold">
                                ${initial}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-slate-900 dark:text-white">${user.name}</span>
                                <span class="text-xs text-slate-500">${user.email}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-medium px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                            ${(user.role || 'User').toUpperCase()}
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 text-xs text-slate-500">
                        ${this.formatTime(user.created_at)}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center gap-2">
                            <button data-id="${user.id}" class="btn-edit-user p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </button>
                            <button data-id="${user.id}" data-name="${user.name}" class="btn-delete-user p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    },

    renderPagination(data) {
        const { current_page, last_page, total, from, to } = data;

        this.paginationContainer.innerHTML = `
            <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:divide-slate-800 flex items-center justify-between">
                <span class="text-xs text-slate-500">Menampilkan ${from || 0} sampai ${to || 0} dari ${total} pengguna</span>
                <div class="flex items-center gap-2">
                    ${current_page > 1
                        ? `<button data-page="${current_page - 1}" class="btn-page px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Sebelumnya</button>`
                        : `<button class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg opacity-50 cursor-not-allowed" disabled>Sebelumnya</button>`
                    }

                    ${current_page < last_page
                        ? `<button data-page="${current_page + 1}" class="btn-page px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Berikutnya</button>`
                        : `<button class="px-3 py-1 text-xs border border-slate-200 dark:border-slate-800 rounded-lg opacity-50 cursor-not-allowed" disabled>Berikutnya</button>`
                    }
                </div>
            </div>
        `;
    },

    formatTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = Math.floor((now - date) / 1000);

        if (diff < 60) return 'Baru saja';
        if (diff < 3600) return `${Math.floor(diff / 60)} menit yang lalu`;
        if (diff < 86400) return `${Math.floor(diff / 3600)} jam yang lalu`;
        return date.toLocaleDateString();
    },

    openModal(editMode = false) {
        this.modalTitle.innerText = editMode ? 'Edit Pengguna' : 'Tambah Pengguna';
        this.submitBtn.innerText = editMode ? 'Simpan Perubahan' : 'Simpan';
        this.passwordHint.classList.toggle('hidden', !editMode);

        this.modal.classList.remove('pointer-events-none', 'opacity-0');
        this.modalContent.classList.remove('scale-95');
        this.modalContent.classList.add('scale-100');
    },

    closeModal() {
        this.modal.classList.add('pointer-events-none', 'opacity-0');
        this.modalContent.classList.add('scale-95');
        this.modalContent.classList.remove('scale-100');
        setTimeout(() => {
            this.form.reset();
            const idField = document.getElementById('user-id');
            if (idField) idField.value = '';
        }, 300);
    },

    openDeleteModal(id, name) {
        this.userToDelete = id;
        const nameDisplay = document.getElementById('delete-user-name');
        if (nameDisplay) nameDisplay.innerText = name;

        this.deleteModal.classList.remove('pointer-events-none', 'opacity-0');
        this.deleteModalContent.classList.remove('scale-95');
        this.deleteModalContent.classList.add('scale-100');
    },

    closeDeleteModal() {
        this.userToDelete = null;
        this.deleteModal.classList.add('pointer-events-none', 'opacity-0');
        this.deleteModalContent.classList.add('scale-95');
        this.deleteModalContent.classList.remove('scale-100');
    },

    async editUser(id) {
        try {
            const result = await UserService.getById(id);
            if (result.code === 200) {
                const user = result.data;
                document.getElementById('user-id').value = user.id;
                document.getElementById('name').value = user.name;
                document.getElementById('email').value = user.email;
                document.getElementById('role').value = user.role || 'user';
                this.openModal(true);
            } else {
                this.showToast('Gagal mengambil data user', 'error');
            }
        } catch (error) {
            this.showToast('Terjadi kesalahan sistem', 'error');
        }
    },

    async handleFormSubmit(e) {
        e.preventDefault();
        const idField = document.getElementById('user-id');
        const id = idField ? idField.value : null;

        const data = {
            id: id || undefined,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            role: document.getElementById('role').value,
            password: document.getElementById('password').value || undefined,
        };

        try {
            console.log('UserController: handleFormSubmit data', data);
            const result = id
                ? await UserService.update(id, data)
                : await UserService.create(data);

            console.log('UserController: handleFormSubmit result', result);

            if (result.code === 200) {
                this.showToast(id ? 'User berhasil diperbarui' : 'User berhasil dibuat', 'success');
                this.closeModal();
                console.log('UserController: Calling fetchUsers for reload');
                this.fetchUsers(); // Refresh table without full reload
            } else {
                this.showToast(result.message || 'Gagal menyimpan data', 'error');
            }
        } catch (error) {
            console.error('UserController: handleFormSubmit catch error', error);
            this.showToast('Terjadi kesalahan koneksi', 'error');
        }
    },

    async handleDelete() {
        if (!this.userToDelete) return;
        try {
            const result = await UserService.delete(this.userToDelete);
            if (result.code === 200) {
                this.showToast('User berhasil dihapus', 'success');
                this.closeDeleteModal();
                this.fetchUsers(); // Refresh table
            } else {
                this.showToast('Gagal menghapus user', 'error');
            }
        } catch (error) {
            this.showToast('Terjadi kesalahan sistem', 'error');
        }
    },

    showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-rose-500';

        toast.className = `${bgColor} text-white px-6 py-3 rounded-xl shadow-xl transform translate-y-10 opacity-0 transition-all duration-500 flex items-center gap-3`;
        toast.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success'
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'}
            </svg>
            <span class="text-sm font-medium">${message}</span>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
        }, 100);

        setTimeout(() => {
            toast.classList.add('translate-y-[-20px]', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }
};
