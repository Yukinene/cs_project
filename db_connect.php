<?php
	$str_server = "localhost";
       $str_username = "root";
       $str_password = "";
       $str_dbname = "cs_project_db";
       $obj_con = mysqli_connect($str_server,$str_username,$str_password);
       mysqli_select_db($obj_con,$str_dbname);
       mysqli_query($obj_con,"SET NAMES UTF8");
       
function database_result($db,$query, $expire = 59) {
   $memcached = new Memcached;
   #$memcached->connect('localhost', 11211) or die ("Could not connect"); #Memcache
   $memcached->addServer('localhost', 11211); 							  #Memcached with 'd'
   $memcached_key = md5($query);
   $cached = $memcached->get($memcached_key);
   //if ($memcached->getResultCode() !== Memcached::RES_NOTFOUND) { not worked
   if ($cached){ 
	   //echo "Cached";
       return $cached;
   }   

   //Init Mysqli connection
   $str_server = "localhost";
   $str_username = "root";
   $str_password = "";
   $str_dbname = $db;
   $mysqli = new mysqli($str_server, $str_username, $str_password, $str_dbname);
   $mysqli->set_charset("UTF8");
   
   //Check connection //
   if ($mysqli->connect_errno) {
   		printf("Connect failed: %s\n", $mysqli->connect_error);
   		exit();
	}
	
   //Perform Query//
   $result = $mysqli->query($query);

   //Fetch associative and numeric array to $result_array//
   while($row =   $result->fetch_array(MYSQLI_ASSOC)) {
    $result_array[] = $row;
   }
   
   $memcached->set($memcached_key, $result_array,false,$expire);
   $mysqli->close();
   //print_r($result_array);
   //echo "No Cached";
   return $result_array;
}
?>
