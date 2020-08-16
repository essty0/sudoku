<?php 
define("USERNAME", '');
define('PASSWORD', '');
define ('BDNAME', '');
define ('MYHOST', '');

require_once("../RedBean/rb-mysql.php");
R::setup( 'mysql:host='. MYHOST . ';dbname=' . BDNAME, USERNAME, PASSWORD );

?>