<?php

class Database {
    public static function connect() {
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $database = "moneysnap";
        $port = 3306;

        $conn = new mysqli($servername, $dbusername, $dbpassword, $database, $port);

        if ($conn->connect_error) {
            die("Database connection error: " . $conn->connect_error);
        }

        return $conn;
    }
}
