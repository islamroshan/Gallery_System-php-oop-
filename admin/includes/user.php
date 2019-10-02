
<?php 

class User extends DB_Object  {
    //this called abstraction
        protected static $db_table = "users";
        protected static $db_table_field = array('username','password','firstname','lastname');
    
        public $username;
        public $id;
        public $password;
        public $firstname;
        public $lastname;


   
      
     public static function verify_user($username,$password)
    {
         
        global $database;
         
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        
        $sql = "SELECT * FROM " . self::$db_table  . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
          
            $result_set = self::find_by_query($sql);           
            return !empty($result_set) ? array_shift($result_set) : false; 
 
 
 
    }
        
 
 
   

    

     
}
?>