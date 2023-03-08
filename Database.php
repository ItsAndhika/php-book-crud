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
        $slug = $this->slugify($title);
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

    public function edit($data)
    {
        $id = $data["id"];
        $title = htmlspecialchars($data["title"]);
        $slug = $this->slugify($title);
        $writer = htmlspecialchars($data["writer"]);
        $year = htmlspecialchars($data["year"]);
        $publisher = htmlspecialchars($data["publisher"]);
        $price = htmlspecialchars($data["price"]);

        $this->stmt = $this->dbh->prepare("UPDATE books SET
                                            title = '$title',
                                            slug = '$slug',
                                            writer = '$writer',
                                            year = $year,
                                            publisher = '$publisher',
                                            price = $price
                                            WHERE id = $id");
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    public function delete($slug)
    {
        $this->stmt = $this->dbh->prepare("DELETE FROM books WHERE slug = '$slug'");
        $this->stmt->execute();
        return $this->stmt->rowCount();
    }

    public function slugify($text)
    {
        $text = preg_replace("/[^A-Za-z0-9]+/", "-", $text);
        $text = iconv("utf-8", "us-ascii//TRANSLIT", $text);
        $text = trim($text, "-");
        $text = strtolower($text);
        if (empty($text)) {
            return "n-a";
        }
        return $text;
    }
}
