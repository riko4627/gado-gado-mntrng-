import './bootstrap';
import { UIController }        from './controllers/uiController';
import { UserController }      from './controllers/userController';
import { AuthController }      from './controllers/authController';
import { ProyektorController } from './controllers/proyektorController';
import { KinexaController }    from './controllers/kinexaController';

/**
 * Main Application Entry Point
 */
document.addEventListener('DOMContentLoaded', () => {
    // Initialize UI Controller (Sidebar, Dark Mode)
    UIController.init();

    // Initialize User Controller (User Management Page)
    UserController.init();

    // Initialize Auth Controller (Login Page)
    AuthController.init();

    // Initialize Proyektor Controller (Proyektor Stats Page & Dashboard)
    ProyektorController.init();

    // Initialize Kinexa Controller (Kinexa Stats Page)
    KinexaController.init();
});
