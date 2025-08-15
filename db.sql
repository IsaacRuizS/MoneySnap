-- Crear base de datos
CREATE DATABASE IF NOT EXISTS moneysnap;
USE moneysnap;

-- Users
CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(190) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL
);

-- Transaction Categories
CREATE TABLE transaction_categories (
    transaction_category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL
);

-- Transactions
CREATE TABLE transactions (
    transaction_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    transaction_category_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    description VARCHAR(500) NULL,
    type VARCHAR(50) NOT NULL, -- o usa ENUM si prefieres
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_tx_user FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_category FOREIGN KEY (transaction_category_id) REFERENCES transaction_categories(transaction_category_id)
);

-- Savings
CREATE TABLE savings (
    saving_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    current_balance DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    deadline DATE NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL,
    CONSTRAINT fk_savings FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
);

-- Expenses
CREATE TABLE expenses (
    expense_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    current_balance DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL,
    CONSTRAINT fk_expenses FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
);

-- Incomes
CREATE TABLE incomes (
    income_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    current_balance DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL,
    CONSTRAINT fk_incomes FOREIGN KEY (transaction_id) REFERENCES transactions(transaction_id)
);
