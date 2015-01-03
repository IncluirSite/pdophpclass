<?php

class bd {

    private static $conexao;
    private $debug;
    private $server;
    private $user;
    private $password;
    private $database;

    public function __construct() {
            $this->debug = true;
            $this->server = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->database = "bdname";
    }

    public function getConnection() {
        try {
            if (self::$conexao == null) {
                self::$conexao = new PDO("mysql:host={$this->server};dbname={$this->database};charset=utf8", $this->user, $this->password);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$conexao->setAttribute(PDO::ATTR_PERSISTENT, true);
            }
            return self::$conexao;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "<b>Error on getConnection(): </b>" . $ex->getMessage() . "<br/>";
            }
            die();
        }
    }

    public function Disconnect() {
        $this->conexao = null;
    }

    public function GetLastID() {
        return $this->getConnection()->lastInsertId();
    }

    public function BeginTransaction() {
        return $this->getConnection()->beginTransaction();
    }

    public function Commit() {
        return $this->getConnection()->commit();
    }

    public function Rollback() {
        return $this->getConnection()->rollBack();
    }

    public function ExecuteQueryOneRow($sql, $parametros = null) {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($parametros);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "<b>Error on ExecuteQueryOneRow():</b> " . $ex->getMessage() . "<br />";
                echo "<br /><b>SQL: </b>" . $sql . "<br />";
                ;
                echo "<br /><b>Parameters: </b>";
                print_r($parametros) . "<br />";
                ;
            }
            die();
            return null;
        }
    }

    public function ExecuteQuery($sql, $parametros = null) {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute($parametros);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "<b>Error on ExecuteQuery():</b> " . $ex->getMessage() . "<br />";
                echo "<br /><b>SQL: </b>" . $sql . "<br />";
               
                echo "<br /><b>Parameters: </b>";
                print_r($parametros) . "<br />";
                ;
            }
            die();
            return null;
        }
    }

    public function ExecuteNonQuery($sql, $parametros = null) {
        try {
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute($parametros);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "<b>Error on ExecuteNonQuery():</b> " . $ex->getMessage() . "<br />";
                echo "<br /><b>SQL: </b>" . $sql . "<br />";
                ;
                echo "<br /><b>Parameters: </b>";
                print_r($parametros) . "<br />";
                ;
            }
            die();
            return false;
        }
    }

}
