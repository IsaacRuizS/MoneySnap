<?php
session_start();
require_once 'SavingsController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $savingsController = new SavingsController();
    
    switch ($action) {
        case 'createSavings':
            $savingsController->createSavings();
            break;
            
        case 'updateSavings':
            $savingsController->updateSavings();
            break;
            
        case 'addMoney':
            $savingsController->addMoney();
            break;
            
        case 'subtractMoney':
            $savingsController->subtractMoney();
            break;
            
        case 'deleteSavings':
            $savingsController->deleteSavings();
            break;
            
        default:
            header('Location: ../view/views/savings.php');
            break;
    }
} else {
    header('Location: ../view/views/savings.php');
}
?>
