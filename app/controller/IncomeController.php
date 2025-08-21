<?php
require_once __DIR__ . '/../model/Income.php';

class IncomeController {

    public function addIncome() {

        // validar sesión activa
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
            return;
        }

        // recoger datos del form
        $amount      = $_POST['amount'] ?? '';
        $category    = $_POST['category'] ?? '';
        $date        = $_POST['date'] ?? '';
        $description = $_POST['description'] ?? '';

        if (empty($amount) || empty($category) || empty($date)) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios']);
            return;
        }

        $income = new Income();

        if ($income->create((int)$_SESSION['user_id'], (float)$amount, $category, $date, $description)) {
            echo json_encode(['status' => 'success', 'message' => 'Ingreso registrado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo registrar el ingreso']);
        }
    }
}
