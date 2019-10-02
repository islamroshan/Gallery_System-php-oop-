<?php
require_once("new_config.php");

class Database
{
    public $connection;
    function __construct()
    {
        $this->open_db_connection();
    }
    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                            // connect_errno is builtin property
        if ($this->connection->connect_errno)
        {
            die("Data connection falid badly" . $this->connection->connect_error);
        }
    }
    public function query($sql)
    {
        $result = $this->connection->query($sql);
        $this->confirmed_query($result);
        return $result;
    }

    private function confirmed_query($result)
    {
        if (!$result)
        {
            die("Qurey Failed". $this->connection->error);
        }
    }

    public function escape_string($string)
    {   
                                                //real_escape_string it is builtin property                        
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }

//    public function the_insert_id() {   
//        return $this->connection->insert_id;
//    }
    
    public function the_insert_id() {
        //this will insert the last  id 
        return mysqli_insert_id($this->connection);
    }
}
$database = new Database();

?>