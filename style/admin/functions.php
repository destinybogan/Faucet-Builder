<?php

function update_settings_query($settings){
  $sql = "";
  try{
    foreach ($settings as $key => $value) {
        $sql .= "update settings set value='$value' where name='$key';";
      }
      return $sql;
    }
    catch(Exception $e){

    }
}


function update_password_query(){
  return "update settings set value=? where name='password'";
}

function query_last_week(){
  return "select COALESCE(sum(amount),0) as value from data where date > DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
}

function query_last_week_referals(){
  return "select COALESCE(sum(amount),0) as value from data_referals where date > DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
}

function query_since_beginning(){
  return "select COALESCE(sum(amount),0) as value from data where result=1";
}

function query_since_beginning_referals(){
  return "select COALESCE(sum(amount),0) as value from data_referals where result=1";
}



?>
