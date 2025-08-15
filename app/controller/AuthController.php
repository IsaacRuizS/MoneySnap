<?php
require_once __DIR__ . '/../model/User.php';

class AuthController {
    
    public function login() {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
            return;
        }

        $user = new User();

        if ($user->login($email, $password)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Credenciales inválidas']);
        }
    }

    public function register() {
        $name     = $_POST['name'] ?? '';
        $lastName = $_POST['lastName'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($name) || empty($lastName) || empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
            return;
        }

        $user = new User();

        if ($user->register($name, $lastName, $email, $password)) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'El correo ya está registrado o hubo un error']);
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../view/views/login.php');
        exit;
    }
}
