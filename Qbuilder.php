<?php

class QBuilder {
   protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;  
    }

     /**
     * string $table - название таблицы
     * return array
     */
    public function getAllRecords($table) {
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql); // готовим запрос
        $statement->execute();        
        return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }

     /**
     * string $table - название таблицы
     * array $data - массив данных
     * return boolean
     */
    public function insertRecord($table, $data) {
        $keys = implode(',', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));          

        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";
        $statement = $this->pdo->prepare($sql);        
        $statement->execute($data);       
    }

    /**
     * string $table - название таблицы
     * int $id - id записи
     * return array
     */
    public function getOneRecord($table, $id) {
        $sql = "SELECT * FROM {$table} WHERE id=:id";        
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);       
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC); 
    }

    /**
     * string $table - название таблицы
     * array $data - массив данных
     * int $id - id записи
     * return array
     */
    public function updateRecord($table, $data, $id) {        
        $keys = array_keys($data);
        
        $string = '';
        foreach($keys as $key) {
            $string .= $key . '=:' . $key . ',';
        }
        $keys = rtrim($string, ',');
        $data['id'] = $id;
        
        $sql = "UPDATE {$table} SET {$keys} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute($data);
    }

   /**
     * string $table - название таблицы
     * int $id - id записи
     * return boolean
     */
    public function deleteRecord($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id=:id";        
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id);        
        $statement->execute();        
    }

}