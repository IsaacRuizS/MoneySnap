<?php

require_once __DIR__ . '/../config/db.php';

class User
{
    private mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function login(string $email, string $password): bool {

        $stmt = $this->db->prepare(
            "SELECT `USER_ID`,`NAME`,`EMAIL`,`PASSWORD`
            FROM `Users` 
            WHERE `EMAIL` = ? AND (`DELETED_AT` IS NULL) 
            LIMIT 1"
        );
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$row || !password_verify($password, $row['PASSWORD'])) {
            return false;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        
        $_SESSION['user_id'] = (int)$row['USER_ID'];
        $_SESSION['name']    = $row['NAME'];
        $_SESSION['email']   = $row['EMAIL'];
        
        return true;
    }

    public function register(string $name, string $lastName, string $email, string $password): bool {

        // Rechazar duplicados
        $chk = $this->db->prepare("SELECT 1 FROM `Users` WHERE `EMAIL` = ? LIMIT 1");
        $chk->bind_param("s", $email);
        $chk->execute();
        $chk->store_result();
        
        if ($chk->num_rows > 0) { 
            $chk->close(); 
            return false; 
        }

        $chk->close();

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql  = "INSERT INTO `Users` (`NAME`,`LAST_NAME`,`EMAIL`,`PASSWORD`,`CREATED_AT`,`UPDATED_AT`,`DELETED_AT`)
                VALUES (?,?,?,?,NOW(),NULL,NULL)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $name, $lastName, $email, $hash);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    } 

    public function update(int $id, string $name, string $lastName, string $email, ?string $password = null): bool {
        
        if ($password !== null && $password !== '') {
        
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql  = "UPDATE `Users`
                    SET `NAME`=?, `LAST_NAME`=?, `EMAIL`=?, `PASSWORD`=?, `UPDATED_AT`=NOW()
                    WHERE `USER_ID`=? AND (`DELETED_AT` IS NULL)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssi", $name, $lastName, $email, $hash, $id);
        } else {
        
            $sql  = "UPDATE `Users`
                    SET `NAME`=?, `LAST_NAME`=?, `EMAIL`=?, `UPDATED_AT`=NOW()
                    WHERE `USER_ID`=? AND (`DELETED_AT` IS NULL)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssi", $name, $lastName, $email, $id);
        }

        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function getById(int $id): ?array {
        
        $sql = "SELECT `USER_ID`, `NAME`, `LAST_NAME`, `EMAIL`
                FROM `Users`
                WHERE `USER_ID` = ? AND (`DELETED_AT` IS NULL)
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $res ?: null;
    }
}
