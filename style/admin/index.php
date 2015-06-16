<?php
session_start();

require '../config.php';
require 'functions.php';

try {
  $sql = new PDO($dbdsn, $mysqlUsername, $mysqlPassword, array(PDO::ATTR_PERSISTENT => true,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOException $e) {
  die($e->getMessage());
}

if(isset($_POST["action"])){
  if($_POST["action"]=='logout'){
    unset($_SESSION['admin']);
    unset($_COOKIE['admin']);
  }
}

if(isset($_POST["password"])){
  $pass = $_POST["password"];
  $query = "select * from settings where name='password' and value='$pass'";
  $res = $sql->query($query)->fetch();
  if($res){
    $_SESSION['admin']=true;
    if(isset($_POST["remember"])&&$_POST["remember"]=="on"){
      setcookie("admin");
    }
    else{
      unset($_COOKIE['admin']);
    }
  }
  else{
    $view["admin_message_html"]='<div class="alert alert-danger" role="alert">
    <span class="sr-only">Error:</span>
    Enter a valid email address
    </div>';
  }
}

if(isset($_COOKIE['remember'])){
  $_SESSION['admin']=true;
}

//check if user is logged in, if not take to login page
if(!$_SESSION['admin']){
  require 'template/login.php';
  die;
}


if(isset($_POST["title"])){
  //update new settings values
  if($_SESSION['admin']){
    $settings = $_POST;
    $insertQuery =  update_settings_query($settings);
    $resultSettings = $sql->query($insertQuery);
  }
}
else{
  if(isset($_POST["new_password"])){
    if($_SESSION['admin']){
      if($_POST["new_password"]==$_POST["password_confirmation"]){
        $updatePassword =  update_password_query();
        $q = $sql->prepare($updatePassword);
        $q->execute(array($_POST["new_password"]));
        unset($_COOKIE['admin']);
        unset($_SESSION['admin']);
        $view["admin_message_html"]='<div class="alert alert-success" role="alert">Password changed successfully.</div>';
        require 'template/login.php';
        die;
      }
      else{
        $view["admin_message_html"]='<div class="alert alert-danger" role="alert">Password does not match confirmation.</div>';
        $queryGeneralSettings = "select * from settings";
        $resultSettings = $sql->query($queryGeneralSettings);

        if ($resultSettings) {
          while ($row = $resultSettings->fetch()) {
            $settings[$row['name']] = $row['value'];
          }
        }

      }
    }
  }
  else{
    $queryGeneralSettings = "select * from settings";
    $resultSettings = $sql->query($queryGeneralSettings);

    if ($resultSettings) {
      while ($row = $resultSettings->fetch()) {
        $settings[$row['name']] = $row['value'];
      }
    }
  }
}

require 'template/index.php';

?>
