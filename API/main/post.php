<?php

class Post{
    //db stuff
    private $conn;
    private $table = 'covid';

    //post properties
    public $Date_reported;
    public $Country_code;
    public $Country;
    public $WHO_region;
    public $New_cases;
    public $Cumulative_cases;
    public $New_deaths;
    public $Cumulative_deaths;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }
     //getting posts from our database 
     public function read() {
        // Create query with proper spacing and aliasing
        $query = 'SELECT
            c.Date_reported,
            c.Country_code,
            c.Country,
            c.WHO_region,
            c.New_cases,
            c.Cumulative_cases,
            c.New_deaths,
            c.Cumulative_deaths
        FROM
            ' . $this->table . ' c';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;

     }
}