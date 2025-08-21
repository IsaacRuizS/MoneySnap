<?php 

require_once __DIR__ . '/../../controller/AuthController.php';
require_once __DIR__ . '/../../controller/ExpenseController.php';
require_once __DIR__ . '/../../controller/IncomeController.php';
require_once __DIR__ . '/../../controller/TransactionController.php';

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

$auth = new AuthController();
$expense = new ExpenseController();
$income = new IncomeController();
$transaction = new TransactionController();

switch ($action) {
    case 'login':
        $auth->login();
        break;
    case 'register':
        $auth->register();
        break;
    case 'getUser':
        $auth->getUser();
        break;
    case 'updateUser':
        $auth->updateUser();
        break;
    case 'addExpense':
        $expense->addExpense();
        break;
    case 'addIncome':
        $income->addIncome();
        break;
    case 'getTransactions':
        $transaction->getAllTransactions();
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Ruta no válida']);
        break;
}
