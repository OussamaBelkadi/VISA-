<?php
// function allow to conect to Database
class DataBase {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dataBaseName = "visa";

    protected function connect() : PDO
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dataBaseName;
        $pdo = new PDO($dsn, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        return $pdo;
    }
}
?>