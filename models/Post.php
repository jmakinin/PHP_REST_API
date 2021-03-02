<?php
class Post{
    //DB stuff

    private $conn;
    private $table = 'posts';

    //Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    //Get Posts
    public function read(){
        //Create Query
        $query = "SELECT 
                c.name as category_name, 
                p.id, 
                p.category_id, 
                p.title, 
                p.body, 
                p.author, 
                p.created_at 
            FROM 
                $this->table p 
            LEFT JOIN 
                categories c ON p.category_id = c.id 
            ORDER BY 
                p.created_at DESC";


        // Prepare statement
        //var_dump($query);

        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;

    }

    //Get single Post
    public function read_single() {
        //Create query
        $query = "SELECT 
                c.name as category_name, 
                p.id, 
                p.category_id, 
                p.title, 
                p.body, 
                p.author, 
                p.created_at 
            FROM 
                $this->table p 
            LEFT JOIN 
                categories c ON p.category_id = c.id 
            WHERE
                p.id = ?
            LIMIT 0,1 ";

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //execute query
        $stmt->execute();

        //Fetch Array
        



    }

}
