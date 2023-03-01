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

    public function getBySlug($slug)
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM books WHERE slug = '$slug'");
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data)
    {
        $title = htmlspecialchars($data["title"]);
        $slug = htmlspecialchars($data["slug"]);
        $writer = htmlspecialchars($data["writer"]);
        $year = htmlspecialchars($data["year"]);
        $publisher = htmlspecialchars($data["publisher"]);
        $price = htmlspecialchars($data["price"]);

        $this->stmt = $this->dbh->prepare("INSERT INTO books VALUES(
                                            NULL,
                                            '$title',
                                            '$slug',
                                            '$writer',
                                            $year,
                                            '$publisher',
                                            $price)");
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }
}
