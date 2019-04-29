<?php

require_once 'db_config.php';

class Database extends DB_Config {

    public $conn;
    public $tablename;
    public $fieldarray;

    public function __construct() {
        //echo "Database constructor <br>";
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
                $this->username,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //echo "connected";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null;
    }

    public function getData($where, $var, $bind){
        $query = "SELECT count(*) FROM $this->tablename WHERE $where=:$bind";
        //echo "<div>$query</div>";
        $stmt = $this->conn-> prepare($query);
        $stmt -> bindParam($bind, $var);
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_NUM);
        $this -> numrows = $result[0];

        if ($this -> numrows <= 0 ){
            return;
        }
        // else fetch the data
        $query = "SELECT * FROM $this->tablename WHERE $where=:$bind ORDER BY id DESC;";
        $stmt = $this->conn -> prepare($query);
        $stmt -> bindParam($bind, $var);
        $stmt -> execute();
        while ($row = $stmt ->fetch(PDO::FETCH_NUM)){
            $this -> data_array[] = $row;
        }
        return $this->data_array;
    }

    function select(){
        $end = end($this->fieldarray);
        //echo "<br> " . $end;
        $query ="SELECT ";
        foreach ($this->fieldarray as $field){
            $query .= $field;
            if ($field!==$end){
                $query .= ', ';
            }
        }
        $query .= " FROM $this->tablename";
        //echo $query;
        $stmt = $this->conn ->prepare($query);
        $stmt -> execute();
        $result = $stmt -> fetchAll(PDO::FETCH_NUM);
        return $result;
    }

    function insert($fieldarray){
        $end = array_key_last($fieldarray);
        //echo $end;
        $query = "INSERT INTO $this->tablename (";
        foreach ($fieldarray as $item => $value) {
            $query .= $item;
            if ($item!==$end){
                $query .= ', ';
            }
        }
        $query .=') VALUES (';
        //$query = rtrim($query, ', ');
        foreach ($fieldarray as $item => $value) {
            $query .= ":$item";
            if ($item!==$end){
                $query .= ',';
            }
        }
        $query .=');';
        $stmt = $this->conn->prepare($query);
        foreach ($fieldarray as $item => $value) {
            $stmt -> bindValue(':'.$item, $value);
        }
        $stmt -> execute();

        $er = $stmt ->errorCode();
//        if ($er==='00000')
//            //echo "<br> uploaded successful";
//        else
//            //echo "<br> no upload";
    }
}