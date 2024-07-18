<?php

class Connection
{
    private static $conn;

    public function __construct()
    {
        self::$conn = new mysqli('localhost', 'utente', 'utente', 'cardmarket');

        if (self::$conn->connect_errno) {
            throw new RuntimeException('mysqli connection error: ' . self::$conn->connect_error);
        }
    }

    public static function getConnessione()
    {
        if (!self::$conn) {
            new self();
        }
        return self::$conn;
    }
}

// Esegui la connessione al database
new Connection();
?>