import './bootstrap';
import { UIController } from './controllers/uiController';
import { UserController } from './controllers/userController';

/**
 * Main Application Entry Point
 */
document.addEventListener('DOMContentLoaded', () => {
    // Initialize UI Controller (Sidebar, Dark Mode)
    UIController.init();

    // Initialize User Controller (User Management Page)
    UserController.init();
});
