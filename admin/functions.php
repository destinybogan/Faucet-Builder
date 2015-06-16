<?php

function hide_key($decriptedKey){
  $length = strlen($decriptedKey);
  $exes = str_repeat("X", $length-4);
  $lastFour = substr($decriptedKey,-4);
  return $exes.$lastFour;
}


function update_settings_query($settings){
  $sql = "";
  try{
    foreach ($settings as $key => $value) {
      if($key!="password"||$key!="xapo_app_id"||$key!="xapo_secret_key"){
        $sql .= "update settings set value='$value' where name='$key';";
        }
      }
      return $sql;
    }
    catch(Exception $e){

    }
}


function update_password_query(){
  return "update settings set value=? where name='password'";
}

function update_keys_query(){
  return "update settings set value=? where name='xapo_app_id';update settings set value=? where name='xapo_secret_key';";
}

function query_last_week(){
  return "select COALESCE(sum(amount),0) as value from data where date > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND result=1";
}

function query_last_week_referals(){
  return "select COALESCE(sum(amount),0) as value from data_referals where date > DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND result=1";
}

function query_since_beginning(){
  return "select COALESCE(sum(amount),0) as value from data where result=1";
}

function query_since_beginning_referals(){
  return "select COALESCE(sum(amount),0) as value from data_referals where result=1";
}



?>
