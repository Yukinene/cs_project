<?php
if(file_exists("../../db_connect.php"))
{require_once("../../db_connect.php");}
else if(file_exists("../../../db_connect.php"))
{require_once("../../../db_connect.php");}
else {
    require_once("../../../../db_connect.php");
}

function clean_xss_sql_i($arr){
    global $obj_con;
    if(isset($arr))
    foreach($arr as $key => $value){
        $arr[$key] = htmlspecialchars(mysqli_real_escape_string($obj_con, 
        preg_replace("/\r\n|\r|\n/","\n",preg_replace('/\'|\"/',"&#39;",$value))));
    } return $arr;
}
?>