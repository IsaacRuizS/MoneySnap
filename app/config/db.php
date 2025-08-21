<?php

class Database {
    public static function connect() {
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "10Ruiz30*";
        $database = "moneysnap";
        $port = 3308;

        $conn = new mysqli($servername, $dbusername, $dbpassword, $database, $port);

        if ($conn->connect_error) {
            die("Database connection error: " . $conn->connect_error);
        }

        return $conn;
    }
}
