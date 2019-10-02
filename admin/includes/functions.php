<?php 
//"__autoload" auto load will find all files  load the classes in it
function classAutoLoader($class) 
{
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    //to check decleared path exists or not
    if(is_file($the_path) && !class_exists($class)){
        require_once($the_path);
    }  
    
}
// we use this because we make multiple loaders
spl_autoload_register('classAutoLoader');
?>