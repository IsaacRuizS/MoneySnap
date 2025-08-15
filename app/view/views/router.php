<?php 

require_once __DIR__ . '/../../controller/AuthController.php';

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

$auth = new AuthController();

switch ($action) {
    case 'login':
        $auth->login();
        break;
    case 'register':
        $auth->register();
        break;
    case 'logout':
        $auth->logout();
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Ruta no válida']);
        break;
}
