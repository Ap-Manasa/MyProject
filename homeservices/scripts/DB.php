<?php

class DB
{
    private const HOST = "localhost";
    private const DBNAME = "services";
    private const USERNAME = "root";
    private const PASSWORD = "";

    private static $conn = null;
    private static $_stmt = null;

    /**
     * Get the PDO connection instance
     *
     * @throws PDOException
     *
     * @return PDO connection object
     */
    public static function getConnection()
    {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::USERNAME, self::PASSWORD);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new PDOException("Connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }

    /**
     * Execute a query on the database
     *
     * @param string $sql SQL query to be executed
     * @param array $params Parameters to be bound
     *
     * @return PDOStatement|false
     */
    public static function query($sql, $params = [])
    {
        try {
            self::$_stmt = self::getConnection()->prepare($sql);
            self::$_stmt->execute($params);
            return self::$_stmt;
        } catch (PDOException $e) {
            throw new PDOException("Query failed: " . $e->getMessage());
        }
    }

    /**
     * Get the PDOStatement object
     *
     * @return PDOStatement|null
     */
    public static function getStmt()
    {
        return self::$_stmt;
    }
}
?>
