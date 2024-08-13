<?php
/*---------- 
*  @author  : marlon vargas
*  @version : 1.0
----------*/

include ('../../config.php');

session_start();
if(isset($_SESSION['sesion_email'])){
    session_destroy();
    header('Location: '.$URL.'/');
}