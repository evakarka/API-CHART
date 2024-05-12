<?php

class Post{
    //db stuff
    private $conn;
    private $table = 'dtemperatures';

    //post properties
    public $Date;
    public $Temp;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }
     //getting posts from our database 
     public function read() {
        // Create query with proper spacing and aliasing
        $query = 'SELECT
            d.Date,
            d.Temp
        FROM
            ' . $this->table . ' d';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;

     }
}