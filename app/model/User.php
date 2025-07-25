<?php
require_once("../config/db.php");

class User {

    public static function register($name, $email, $password) {
        global $conn;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO Users (NAME, EMAIL, PASSWORD, CREATED_AT) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $name, $email, $hash);
        return $stmt->execute();
    }

    public static function login($email, $password) {

        global $conn;
        $stmt = $conn->prepare("SELECT * FROM Users WHERE EMAIL = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['PASSWORD'])) {
            return $user;
        }

        return false;
    }

    public static function findById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM Users WHERE USER_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM Users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function update($id, $name, $email, $password = null) {
        global $conn;
    
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE Users SET NAME = ?, EMAIL = ?, PASSWORD = ?, UPDATED_AT = NOW() WHERE USER_ID = ?");
            $stmt->bind_param("sssi", $name, $email, $hash, $id);
        } else {
            $stmt = $conn->prepare("UPDATE Users SET NAME = ?, EMAIL = ?, UPDATED_AT = NOW() WHERE USER_ID = ?");
            $stmt->bind_param("ssi", $name, $email, $id);
        }
    
        return $stmt->execute();
    }
}
