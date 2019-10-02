<?php 
require_once("new_config.php");
require_once("database.php");
require_once("functions.php");
require_once("session.php");


defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS . 'C' . DS . 'xamppnew' . DS . 'htdocs' . DS . 'gallery' );

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes' );

?>
<?php require_once("user.php"); ?>
<?php require_once("db_object.php"); ?>