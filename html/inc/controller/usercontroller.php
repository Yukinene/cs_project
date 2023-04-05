<?php 
  include __DIR__.'/../session.php';

//CAPTCHA
if (isset($_POST['cf-turnstile-response'])) {
  $captcha = $_POST['cf-turnstile-response'];
  $secretKey = "0x4AAAAAAADwjIjR3QF7_9O7Of0nabGFSUk";
  $ip = $_SERVER['REMOTE_ADDR'];

  $url_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
  $data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);
 
 $options = array(
   'http' => array(
   'method' => 'POST',
   'header' => 'Content-type:application/x-www-form-urlencoded',
   'content' => http_build_query($data))
 );
 
 $stream = stream_context_create($options);
 
 $result = file_get_contents(
     $url_path, false, $stream);
 
 $response =  $result;
  
  $responseKeys = json_decode($response,true);
  //print_r ($responseKeys);
   if(intval($responseKeys["success"]) !== 1) {
    array_push($errors, "ยืนยันตัวตนไม่สำเร็จ");
   } else { 
       // REGISTER USER
       if (isset($_POST['reg_user'])) {
        // receive all input values from the form
        $role = mysqli_real_escape_string($db, $_POST['role']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $surname = mysqli_real_escape_string($db, $_POST['surname']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
      
        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) { array_push($errors, "ต้องการชื่อผู้ใช้"); }
        if (empty($name)) { array_push($errors, "ต้องการชื่อ"); }
        if (empty($surname)) { array_push($errors, "ต้องการนามสกุล"); }
        if (empty($email)) { array_push($errors, "ต้องการอีเมล"); }
        if (empty($password_1)) { array_push($errors, "ต้องการรหัสผ่าน"); }
        if ($password_1 != $password_2) {
        array_push($errors, "รหัสผ่านทั้งสองไม่ตรงกัน");
        }
      
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if ($user) { // if user exists
          if ($user['username'] === $username) {
            array_push($errors, "ชื่อผู้ใช้นี้นี้มีอยู่ในระบบ");
          }
      
          if ($user['email'] === $email) {
            array_push($errors, "อีเมลนี้มีอยู่ในระบบ");
          }
        }
      
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
          $password = md5($password_1);//encrypt the password before saving in the database
      
          $query = "INSERT INTO users (role,username,name,surname, email, password) 
                VALUES('$role','$username','$name','$surname', '$email', '$password')";
          mysqli_query($db, $query);
          $_SESSION['username'] = $username;
          $_SESSION['role'] = $role;
          header('location: ../../index.php');
        }
      }
    // ... 
    // LOGIN USER
    if (isset($_POST['login_user'])) {
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $password = mysqli_real_escape_string($db, $_POST['password']);
  
      if (empty($username)) {
        array_push($errors, "ต้องการชื่อผู้ใช้");
      }
      if (empty($password)) {
        array_push($errors, "ต้องการรหัสผ่าน");
      }
  
      if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $result = mysqli_fetch_array($results);
          $_SESSION['username'] = $username;
          $_SESSION['role'] = $result['role'];
          header('location: ../../index.php');
        }else {
          array_push($errors, "username หรือ password ผิดพลาดกรุณาลองอีกครั้ง");
        }
      }
    } 
  }
}
  // CHANGE USER INFO
  if (isset($_POST['cha_info'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_new']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_old']);
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($name)) { array_push($errors, "ต้องการชื่อ"); }
    if (empty($surname)) { array_push($errors, "ต้องการนามสกุล"); }
    if (empty($email)) { array_push($errors, "ต้องการอีเมล"); }
    if (!empty($password_1)) {
      if (empty($password_2)) { array_push($errors, "ต้องการรหัสผ่านเก่า"); }
      else{
        $password_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
      $password = mysqli_query($db, $password_check_query);
      $user = mysqli_fetch_assoc($password);
       if ($user['password'] === md5($password_2)) {
        if ($user['password'] === md5($password_1)) {
          array_push($errors, "ห้ามตั้งรหัสผ่านตรงกัน");
        }
        }
       else
       {
        array_push($errors, "รหัสผ่านเก่าไม่ถูกต้อง");
       }
      }
      
  }
  
    // first check the database to make sure 
    // a email does not same with the user already exist
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
      if ($user['email'] === $email && $user['username'] !=$username) {
        array_push($errors, "อีเมลนี้มีอยู่ในระบบ");
      }
    }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
      if(!empty($password_1)){
        $password = md5($password_1);//encrypt the password before saving in the database
        $query = "UPDATE `users` SET `name`='" .$name. "',`surname`='" .$surname. "',`email`='" .$email. "',`password`='" .$password. "' WHERE username='$username'";
      }
      else {
        $query = "UPDATE `users` SET `name`='" .$name. "',`surname`='" .$surname. "',`email`='" .$email. "' WHERE username='$username'";
      }
      mysqli_query($db, $query);
      array_push($completes, "แก้ไขสำเร็จ");
    }
  }
?>
