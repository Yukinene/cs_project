<?php 
  require 'session.php';
  function checkusername()
  {
    if (isset($_SESSION['username'])) {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  function checkrole($role)
  {
    if(isset($_SESSION['role']) && $_SESSION['role'] == $role)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  function checkuser()
  {
	if (!checkusername()) {
  	$_SESSION['msg'] = "คุณต้องเข้าสู่ระบบก่อน";
  	header('location: ../../util/registration/login.php');
	}
  }
  function checkadmin()
  {
    checkuser();
    if (!checkrole('admin')) {
      $_SESSION['msg'] = "ไม่ได้รับการอนุญาติให้เข้าถึง";
      header('location: ../../index.php');
    }
  }
?>