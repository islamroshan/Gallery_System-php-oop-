
<?php 
class User extends DB_Object  

{
    //this called abstraction
        protected static $db_table = "users";
        protected static $db_table_field = array('username','password','firstname','lastname','user_image','size','type');
    
        public $username;
        public $id;
        public $password;
        public $firstname;
        public $lastname;
        public $user_image;
        public $tmp_path;
        public $upload_directory = "images";
        public $image_placeholder = "http://placehold.it/400x400&text=image";

        public function image_path_and_placeholder()
        {
            return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
        }
        public function user_pic_path()
        {
            return $this->upload_directory.DS.$this->user_image;
        }
        public function delete_user()
       {
        if($this->delete())
        {
            $target_path =   $this->image_path_and_placeholder();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
        }
    
    public function set_files($file)
    {
        if(empty($file) || !$file || !is_array($file))
        {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } elseif($file['error'] != 0 )  
        {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }  else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
    public function save_user_and_image()
    {
        
            if(!empty($this->errors))
            {
                return false;
            }
            if(empty($this->user_image) || empty($this->tmp_path))
            {
                $this->errors[] = "The File was not available";
                return false;
            }
            $target_path =   $this->upload_directory . DS . $this->user_image;
            
            if(file_exists($target_path)) 
            {
                $this->errors[] = "the file {$this->user_image} already exixts";
                return false;
            }
            
            if(move_uploaded_file($this->tmp_path,  $target_path)) 
            {   
                unset($this->tmp_path);
                return true;
            } else 
            {
                $this->errors[] = "the file  directory probably  does not have permission";
                return false;
            }
    }

   
      
     public static function verify_user($username,$password)
    {
         
        global $database;
         
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        
        $sql = "SELECT * FROM " . self::$db_table  . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
          
            $result_set = self::find_by_query($sql);           
            return !empty($result_set) ? array_shift($result_set) : false; 
 
 
 
    }
    public function ajax_save_user_image($user_image,$user_id)
    {
        global $database;
        $user_image =  $database->escape_string($user_image);
        $user_id = $database->escape_string($user_id);

         $this->id = $user_id;
        $this->user_image = $user_image;

          $sql = "UPDATE " . static::$db_table  . " SET user_image = '{$this->user_image}' ";
            $sql .= " WHERE id =  {$this->id} ";
            $update_image =    $database->query($sql);

            echo $this->image_path_and_placeholder();

          


       
      
    }
        
 
 
   

    

     
}
?>