<?php
require_once __DIR__ . '/../config/db.php';

class Transaction {

    public static function create($userId, $amount, $type, $description, $category) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO Transactions (USER_ID, AMOUNT, TYPE, DESCRIPTION, TRANSACTION_CATEGORY_ID, CREATED_AT) VALUES (?, ?, ?, ?, ?, NOW())");
        
        // Obtener el ID de la categoría basado en el tipo
        $categoryId = self::getCategoryIdByType($type);
        
        $stmt->bind_param("idssi", $userId, $amount, $type, $description, $categoryId);
        $result = $stmt->execute();
        
        if ($result) {
            $insertId = $conn->insert_id;
            $conn->close();
            return $insertId;
        }
        
        $conn->close();
        return false;
    }

    public static function all() {
        $conn = Database::connect();
        $result = $conn->query("SELECT * FROM Transactions");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    }

    public static function findById($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM Transactions WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $conn->close();
        return $data;
    }

    public static function delete($id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM Transactions WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    private static function getCategoryIdByType($type) {
        $conn = Database::connect();
        
        // Mapeo de tipos a categorías
        $categoryMap = [
            'income' => 1,      // Ingresos
            'expense' => 2,     // Gastos
            'savings' => 3      // Ahorros
        ];
        
        $categoryId = $categoryMap[$type] ?? 1; // Default a ingresos si no se encuentra
        $conn->close();
        
        return $categoryId;
    }
}
?>
