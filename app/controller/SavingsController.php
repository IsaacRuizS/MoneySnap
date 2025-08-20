<?php
require_once __DIR__ . '/../model/Saving.php';

class SavingsController {
    
    public function getUserSavings() {
        
        if (!isset($_SESSION['user_id'])) {
            return ['status' => 'error', 'message' => 'Usuario no autenticado'];
        }

        $saving = new Saving();
        $data = $saving->getUserSavings($_SESSION['user_id']);

        if ($data) {
            return ['status' => 'success', 'data' => $data];
        } else {
            return ['status' => 'success', 'data' => []];
        }
    }
    
    public function createSavings() {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $name = $_POST['name'] ?? '';
        $amount = floatval($_POST['amount'] ?? 0);

        if (empty($name) || $amount <= 0) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $saving = new Saving();
        
        if ($saving->create($_SESSION['user_id'], $name, $amount)) {
            header('Location: ../view/views/savings.php');
        } else {
            header('Location: ../view/views/savings.php');
        }
    }
    
    public function updateSavings() {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $id = intval($_POST['id'] ?? 0);
        $name = $_POST['name'] ?? '';

        if ($id <= 0 || empty($name)) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $saving = new Saving();

        // Obtener el ahorro actual
        $currentSaving = $saving->getById($id);
        if (!$currentSaving) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $amount = $currentSaving['AMOUNT'];
        
        if ($saving->update($id, $amount, $name)) {
            header('Location: ../view/views/savings.php');
        } else {
            header('Location: ../view/views/savings.php');
        }
    }
    
    public function addMoney() {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $id = intval($_POST['id'] ?? 0);
        $amount = floatval($_POST['amount'] ?? 0); 


        if ($id <= 0 || $amount <= 0) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $saving = new Saving();
        
        // Obtener el ahorro actual
        $currentSaving = $saving->getById($id);
        if (!$currentSaving) {
            header('Location: ../view/views/savings.php');
            return;
        }
        
        $newAmount = $currentSaving['AMOUNT'] + $amount;
        
        if ($saving->update($id, $newAmount, $currentSaving['DESCRIPTION'])) {
            header('Location: ../view/views/savings.php');
        } else {
            header('Location: ../view/views/savings.php');
        }
    }

    public function subtractMoney() {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $id = intval($_POST['id'] ?? 0);
        $amount = floatval($_POST['amount'] ?? 0); 


        if ($id <= 0 || $amount <= 0) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $saving = new Saving();
        
        // Obtener el ahorro actual
        $currentSaving = $saving->getById($id);
        if (!$currentSaving) {
            header('Location: ../view/views/savings.php');
            return;
        }
        
        $newAmount = $currentSaving['AMOUNT'] - $amount;
        
        if ($saving->update($id, $newAmount, $currentSaving['DESCRIPTION'])) {
            header('Location: ../view/views/savings.php');
        } else {
            header('Location: ../view/views/savings.php');
        }
    }
    
    public function deleteSavings() {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $id = intval($_POST['id'] ?? 0);

        if ($id <= 0) {
            header('Location: ../view/views/savings.php');
            return;
        }

        $saving = new Saving();
        
        if ($saving->delete($id)) {
            header('Location: ../view/views/savings.php');
        } else {
            header('Location: ../view/views/savings.php');
        }
    }
}
?>
