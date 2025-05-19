<?php

class Db {

    private $statement;
    private $conn;
    private $params;
    private $className;

    public function __construct()
    {
        require "App/Config/env.php";
        try {
            $this->conn = new PDO("mysql:host={$env["server"]};dbname={$env["database"]}", $env["user"], $env["password"]);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->statement = "";
            $this->params = [];
            $this->className = "";
        //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function builder() 
    {
        $db = new Db();
        return $db;
    }

    public function className($clsName)
    {
        $this->className = $clsName;
        return $this;
    }

    public function statement($stm)
    {
        $this->statement = $stm;
        return $this;
    }

    public function params($stm)
    {
        $this->params = $stm;
        return $this;
    }

    public function query()
    {
        if(empty($this->statement) || empty($this->className)) {
            echo "Not found statement or classname";
            return;
        }

        $stmt = $this->conn->prepare($this->statement);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        $stmt->execute($this->params);
        return $stmt;
    }

    public function execute()
    {
        if(empty($this->statement)) {
            echo "Not found statement";
            return;
        }

        $stmt = $this->conn->prepare($this->statement);
        $stmt->execute($this->params);

        return $this;
    }
    
    public function close()
    {
        $this->conn = null;
    }

    public function __destruct()
    {
        $this->close();
    }
}


