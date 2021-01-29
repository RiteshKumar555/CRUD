<?php

class Connection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "webkul";
    private $dbname = "mydb";
    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function query($sql){
        if(mysqli_query($this->connection, $sql)){

        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($this->connection);

        }
    }

    public function escape($string){
        return mysqli_real_escape_string($this->connection, $string);
    }
    
    public function numRow($sql) {
        
        $result = $this->connection->query($sql);

        return mysqli_num_rows($result);
    }

    public function fetchAssoc($sql) {
        
        $result = $this->connection->query($sql);

        return mysqli_fetch_assoc($result);
    }

    public function fetchAssocs($sql) {
        
        $result = $this->connection->query($sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row; 
        }
        return $rows;
    }

}