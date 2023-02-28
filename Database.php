<?php
class Database
{
    private $host = "localhost",
        $username = "root",
        $password = "",
        $db_name = "crud",
        $dbh, $stmt;

    public function __construct()
    {
        try {
            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Failed : " . $e->getMessage());
        }
    }

    public function getAll()
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM books");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
