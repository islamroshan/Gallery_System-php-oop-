<?php 

class DB_Object 
{
  
    
        // query to find all users by id
        public static function find_by_id($id) 
        {
             global $database;
            $result_set = static::find_by_query("SELECT * FROM " . static::$db_table  . " WHERE id = $id ");           
            return !empty($result_set) ? array_shift($result_set) : false; 
            
        }
    
        // query to find all users
        public static function find_all_users() 
        {
            return static::find_by_query("SELECT * FROM " . static::$db_table  . "  ");     
        }
    
        //send the query and fetching data in array
        public static function find_by_query($sql)
        {
            global $database;
            $result_set = $database->query($sql);
            $the_object_array =  array();
            while($row = mysqli_fetch_array($result_set)){
                 $the_object_array[] = static::instantiate($row);
            }
            return  $the_object_array;
        }
    
        //getting value form database and assigning it to the variables created in class
        public static function instantiate($the_record) 
        {
            $calling_class = get_called_class();
            $the_object = new $calling_class;

            foreach($the_record as $the_attributes => $values)
            {
                if($the_object->has_the_attributes($the_attributes))
                {
                    $the_object->$the_attributes = $values;
                }
            }
            return $the_object;
        }
    
        //to check if created objects have keys 
        private function has_the_attributes($the_attributes) 
        {
                            //collect all objects in this class in a form of array
        $object_properties = get_object_vars($this);
        //if these objects have keys it will return true else false
        return array_key_exists($the_attributes,$object_properties);
        }
    
        protected function properties()
        {
        //  return get_object_vars($this);
        $properties = array();
        foreach( static::$db_table_field as $db_field) 
        {
            if(property_exists($this,$db_field)) 
            {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
        }
    
        protected function clean_properties()
        {
            global $database;
            //        return get_object_vars($this);
            $clean_properties = array();
            foreach( $this->properties() as $keys => $values) 
            {
                 $clean_properties[$keys] = $database->escape_string($values);
            }
            return $clean_properties;
        }
        public function create()
        {
           global $database;
           $properties = $this->clean_properties();
                                                            //we use implode to seperate keys coming in arry in prperti with a comma
           $sql = "INSERT INTO " . static::$db_table  . "(" . implode(",", array_keys($properties)) . ")";
           $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";


           if($database->query($sql))    
           {
                //This Will assign the last insert id to $this->id
                $this->id = $database->the_insert_id();
               return true;
           } else {

               return false;
           }
        }
    
        public function update()
        {
           global $database;
            $properties = $this->properties();
            $properties_pairs = array();
            foreach($properties as $keys => $values)
            {
                $properties_pairs[] = "{$keys}='{$values}'";
            }
            $sql = "UPDATE " . static::$db_table  . " SET ";
           $sql .=  implode("," , $properties_pairs ) ;
            $sql .= " WHERE id = " . $database->escape_string($this->id) ;


            $database->query($sql);

            return (mysqli_affected_rows($database->connection) == 1) ? true : false;

 
        }
         public function delete()
        {
           global $database;

            $sql = "DELETE FROM " . static::$db_table  . " ";
            $sql .= " WHERE id = " . $database->escape_string($this->id);
            $sql .= " LIMIT 1 ";
            
            $database->query($sql);

            return (mysqli_affected_rows($database->connection) == 1) ? true : false;


        }
    
        //if id is available then it will update othwise ot il create
        public function save()
        {
            return isset($this->id) ? $this->update() : $this->create();
        }
}

?>
