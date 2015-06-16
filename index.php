<?php
require 'config.php';
require 'functions.php';
require 'sql.php';

if(!validHash($myHashKey)){
  die("Invalid Hash key. Open your config.php file and enter a 32 digit key made with numbers or letters from A to F.<br>Suggestion: use some random text generator to make it safer.");
}


error_reporting(0);
fix_magic_quotes();

$settings      = array();
$time          = time();
try {
    $sql = new PDO($dbdsn, $mysqlUsername, $mysqlPassword, array(PDO::ATTR_PERSISTENT => true,
                                                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOException $e) {
    echo "Could not connect to the database. Check your config.php file.";
}
try{
$sql->query($create_tables);
$sql->query($insert_settings);
}
catch(Exception $ex){

  echo $ex->getMessage();
}

//general settings
$queryGeneralSettings = "select * from settings";
$resultSettings = $sql->query($queryGeneralSettings);

if ($resultSettings) {
  while ($row = $resultSettings->fetch()) {
    $settings[$row['name']] = $row['value'];
  }
}



if($settings["password_set"]=='0'){
if(isset($_POST["new_password"])){
  if($_POST["new_password"]==$_POST["password_confirmation"]){
    $q = $sql->prepare($change_password);
    $encrypted_pass = encryption($myHashKey,$_POST["new_password"]);
    $q->execute(array($encrypted_pass,"1"));
    $q->closeCursor();
    $settings["password_set"]='1';
  }
}
}

if($settings["password_set"]=='0'){
  require 'first_time.php';
  die;
}



$GLOBALS["settings"] = $settings;
$GLOBALS["hashKey"] = $myHashKey;

$rewards = get_rewards();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST["new_password"])) {

  $view['main']['result_html']  = '';
  $view['main']['waiting_time'] = 0;
  $success                      = "false";
  $ip                           = get_ip();

  //Checks that the username is not empty
  if (!isset($_POST['username'])||$_POST['username']=="") {
    $view['main']['result_html'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-danger"><p>Missing email address!</p></div></div>';
    $message                     = "Missing email address";
    goto error;
  }

  $username = $_POST['username'];
  //Checks if the user has written something in the captcha box

  $captchaChallange = $_POST['adcopy_challenge'];
  $captchaResponse  = $_POST['adcopy_response'];

  if (empty($captchaChallange) || empty($captchaResponse)) {

    $view['main']['result_html'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-danger"><p>Missing captcha, try again!</p></div></div>';
    $message                     = "Missing captcha";
    goto error;
  }


  $response = @file('http://verify.solvemedia.com/papi/verify?privatekey=' . $settings['solvemedia_verification_key'] . '&challenge=' . rawurlencode($captchaChallange) . '&response=' . rawurlencode($captchaResponse) . '&remoteip=' . $ip);

  if (!isset($response[0]) || trim($response[0]) === 'false'){
    $view['main']['result_html'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-danger"><p>Wrong captcha!</p></div></div>';
    $message                     = "Wrong captcha";
    goto error;
  }

  $q = $sql->prepare("select * from users where LOWER(username) = LOWER(?) or ip = ? order by claimed_at desc");
  $q->execute(array($username,$ip));
  $row = $q->fetch();
  //timer check

  if ($row === null || $row['claimed_at'] <= $time - ($settings['timer'] * 60)) {
    $amount = intval($rewards['random_reward']);


    $response = pay($username,$amount,"Earnings from XXX, payed through Xapo!");
    try{
      $message=$response->message;

      if(!$response->success){
        $success = 0;
      }
      else{
        $success = 1;
      }
      $q = $sql->prepare("INSERT into data (user, amount, date, result, message) values (?, ?, CURRENT_TIMESTAMP, ?, ?)");
      $q->execute(array($username,$amount,$success,$message));
    }
    catch(Exception $e){
      goto error;
    }

    if($response->success){
      $view['main']['result_html'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-success"><p>Congratulations you have won '.$amount.' Satoshis !!!</p></div></div>';
      $url = get_main_url()."?r=".$username;
      $view['main']['ref_link'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-success"><p>Share your referal link and earn a '.$settings["referral_percentage"].'% lifetime bonus. Your referal link is '.$url.'</p></div></div>';

      $q = $sql->prepare("INSERT into users (username, ip, claimed_at) values (?,?,?) on duplicate key update ip = values(ip), claimed_at = values(claimed_at)");
      $q->execute(array($username, $ip, $time));

      $q = $sql->prepare("Select * from referals where username=?");
      $q->execute(array($username));
      $row = $q->fetch();

      $ref=null;

      if(!$row){
        //new user
        $ref = $_GET["r"];

        $q = $sql->prepare("INSERT into referals(username,reffered_by) Values(?,?)");
        $q->execute(array($username,$ref));

      }
      else{
        $ref = $row["reffered_by"];
      }

      if(!is_null($ref)){
        $refAmount = $amount * ($settings["referral_percentage"]/100);
        $response = pay($ref,$refAmount,"Referral earnings from XXX, payed through Xapo!");
        if(!$response->success){
          $success = 0;
        }
        else{
          $success = 1;
        }
        $q = $sql->prepare("INSERT into data_referals (user, referrer, amount, date, result, message) values (?,?,?,now(),?,?)");
        $q->execute(array($ref, $username, $refAmount, $success, $response->message));

      }

    }
    else{
      $view['main']['result_html'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-danger"><p>'.$response->message.'</p></div></div>';
      $message                     = $response->message;
      goto error;
    }

  }
  else{

    $waitingTime = ($row['claimed_at'] + ($settings['timer'] * 60)) - $time;
    if ($waitingTime > 0) {
      $waitingTime                  = format_timer($waitingTime);
    }
    $view['main']['result_html'] = '<div class="row text-center"><div class="col-sm-6 col-md-offset-3 bg-danger"><p>You can get a reward again in ' . htmlspecialchars($waitingTime) . '.</p></div></div>';
    $message                     = "Time!!";
    goto error;

  }

  error:

  require 'style/template/index.php'  ;
  exit;
} else {
  require 'style/template/index.php';
  exit;
}
