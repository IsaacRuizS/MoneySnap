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

    public function getUser() {

        //validar sesion activa 
        session_start();
        if (!isset($_SESSION['user_id'])) {

            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
            return;
        }

        $user = new User();
        $data = $user->getById((int)$_SESSION['user_id']);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se encontró el usuario']);
        }
    }

    public function updateUser() {

        //validar sesion activa 
        session_start();
        if (!isset($_SESSION['user_id'])) {

            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
            return;
        }

        $id       = (int)$_SESSION['user_id'];// como solo actualizo mi usuario, tomo el id de session
        $name     = $_POST['name'] ?? '';
        $lastName = $_POST['lastName'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? null;

        if (empty($name) || empty($lastName) || empty($email)) {

            echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios']);
            return;
        }

        $user = new User();

        if ($user->update($id, $name, $lastName, $email, $password)) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el usuario']);
        }
    }
}
