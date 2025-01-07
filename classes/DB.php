<?php

class DB {

    private $conn;
    public $pdo;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
        if (mysqli_connect_errno()) {
            echo 'Failed to connect to MySql ' . mysqli_connect_errno();
            die;
        }
        $this->pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);
    }

    public function query($sql){
        // try
        // {
            $q = $this->pdo->query($sql);
            if(!$q){
                // throw new Exception('Error executing query...');
                return;
            }
            $data = $q->fetchAll();
            return $data;
        // }
        // catch(Exception $e)
        // {
        //     throw $e;
        // }
    }

    public function execute($sql){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function select_all($tableName, $columns = array()) {

        $query = 'SELECT ';

        $strCol = '';
        //var_dump($columns); die;
        foreach($columns as $colName) {
            $strCol .= ' '. esc($colName) . ',';
        }
        $strCol = substr($strCol, 0, -1);

        $query .= $strCol . ' FROM ' . $tableName;

        $result = mysqli_query($this->conn, $query);
        $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);

        return $resultArray;
    }
    
    public function select_one($tableName, $id, $columns = ['*']) {
        // Se $columns non è un array, genera un'eccezione
        if (!is_array($columns)) {
            throw new InvalidArgumentException("Columns must be an array.");
        }
    
        // Prepara i nomi delle colonne per la query
        $columnsList = implode(',', $columns);
    
        // Costruisci la query
        $sql = "SELECT {$columnsList} FROM {$tableName} WHERE id = :id";
    
        // Prepara ed esegui la query
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Ritorna il risultato
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function delete_one($tableName, $id) {
    
        $id = esc($id);
        $query = "DELETE FROM $tableName WHERE id = $id";
    
        if (mysqli_query($this->conn, $query)) {
          $rowsAffected = mysqli_affected_rows($this->conn);
    
          return $rowsAffected;
        } else {
    
          return -1;
        }
    }
    
    public function update_one($tableName, $id, $columns = array()) {
    
        $id = esc($id);
        $strCol = '';
        foreach($columns as $colName => $colValue) {
          $colName = esc($colName);
          $strCol .= " " . $colName . " = '$colValue' ,";
        }
        $strCol = substr($strCol, 0, -1);
    
        $query = "UPDATE $tableName SET $strCol WHERE id = $id";
    
        if (mysqli_query($this->conn, $query)) {
          $rowsAffected = mysqli_affected_rows($this->conn);
    
          return $rowsAffected;
        } else {
    
          return -1;
        }
    }
    
    public function insert_one ($tableName, $columns = array()) {
    
        $strCol = '';
        foreach($columns as $colName => $colValue) {
          $colName = esc($colName);
          $strCol .= ' ' . $colName . ',';
        }
        $strCol = substr($strCol, 0, -1);
    
        $strColValues = '';
        foreach($columns as $colName => $colValue) {
          $colValue = esc($colValue);
          $strColValues .= " '" . $colValue . "' ,";
        }
        $strColValues = substr($strColValues, 0, -1);
    
        $query = "INSERT INTO $tableName ($strCol) VALUES ($strColValues)";
        //var_dump($query); die;
        if (mysqli_query($this->conn, $query)) {
          $lastId = mysqli_insert_id($this->conn);
    
          return $lastId;
        } else {
    
          return -1;
        }
    }
}
    
class DBManager {
    
    protected $db;
    protected $columns;
    protected $tableName;

    public function __construct(){
        $this->db = new DB();
    }

    public function get($id) {
        $resultArr = $this->db->select_one($this->tableName, (int)$id);
        return (object) $resultArr;
    }

    public function getAll() {
        $results = $this->db->select_all($this->tableName, $this->columns);
        $objects = array();
        foreach($results as $result) {
            array_push($objects, (object)$result);
        }
        return $objects;
    }

    public function create($obj) {
        $newId = $this->db->insert_one($this->tableName, (array) $obj);
        return $newId;
    }

    public function delete($id) {
        $rowsDeleted = $this->db->delete_one($this->tableName, (int)$id);
        return (int) $rowsDeleted;
    }

    public function update($obj, $id) {
        $rowsUpdated = $this->db->update_one($this->tableName, (array) $obj, (int)$id);
        return (int) $rowsUpdated;
    }
    
}