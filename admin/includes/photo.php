<?php

class Photo  extends DB_Object
{
        protected static $db_table = "photos";
        protected static $db_table_field = array('id','title','caption','description','alternate_text','filename','type','size');
    
        public $id;
        public $title;
        public $caption;
        public $description;
        public $alternate_text;
        public $filename;
        public $type;
        public $size;
    
        public $tmp_path;
        public $upload_directory = "images";
        public $errors = array();
        public $upload_errors_array = array (
            
            //these all are file upload errors constants and built in
            UPLOAD_ERR_OK  => "There is  no error",
            UPLOAD_ERR_INI_SIZE => "The Upload File Exceeds the upload_max_filesize Directive",
            UPLOAD_ERR_FORM_SIZE => "The Upload File Exceeds the Upload Max_File_Size Directive",
            UPLOAD_ERR_PARTIAL =>  "The Upload file war only partially uploaded",
            UPLOAD_ERR_NO_FILE => "No File Was Uplooaded",    
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary Folder",
            UPLOAD_ERR_CANT_WRITE => "Failed to Write File to Disk",
            UPLOAD_ERR_EXTENSION => "A PHP extension Stopped  the File Upload"
 
        );
    
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
    public function save()
    {
        if($this->id)
        {
            $this->update();
        } else {
            if(!empty($this->errors))
            {
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path))
            {
                $this->errors[] = "The File was not abailable";
                return false;
            }
            $target_path =   $this->upload_directory . DS . $this->filename;
            
            if(file_exists($target_path)) 
            {
                $this->errors[] = "the file {$this->filename} already exixts";
                return false;
            }
            
            if(move_uploaded_file($this->tmp_path,  $target_path)) 
            {
                if( $this->create()) 
                {
                    unset($this->tmp_path);
                    return true;
                } 
            } else 
            {
                $this->errors[] = "the file  directory probably  does not have permission";
                return false;
            }
        }
    }
    public function photo_path()
    {
        return $this->upload_directory . DS . $this->filename;
    }
   public function delete_photo()
    {
        if($this->delete())
        {
            $target_path =   $this->photo_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }
// down wala  method modal ka jo side bar ha waha pa image ka data show kare ga
    public static  function display_sidebar_data($photo_id)
    {
        $photo = Photo::find_by_id($photo_id);

        $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->photo_path()}' ></a>";
        $output .= "<p>{$photo->filename}</p>";
        $output .= "<p>{$photo->type}</p>";
        $output .= "<p>{$photo->size}</p>";

        echo $output;

    }
}

?>
