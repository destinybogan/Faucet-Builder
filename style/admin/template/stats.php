<?php

/*try {
  $sql = new PDO($dbdsn, $mysqlUsername, $mysqlPassword, array(PDO::ATTR_PERSISTENT => true,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOException $e) {
  die($e->getMessage());
}*/

echo "antes";
$amountWeek = $sql->query(query_last_week())->fetch()["value"];
echo "paso week";
$amountWeekRef = $sql->query(query_last_week_referals())->fetch()["value"];
echo "paso week ref";
$amountBeginning = $sql->query(query_since_beginning())->fetch()["value"];
echo "paso amount beg";
$amountBeginningRef = $sql->query(query_since_beginning_referals())->fetch()["value"];
echo "paso amounr ref";

?>
<style>
.stat {
  margin-top:10px;
  font-size: larger;
  padding: 16px;
  margin-bottom: 16px;
  border: 1px solid #e6e6e6;
  background: white;
}
</style>
<div class="row">
  <h3 class="text-center">Your stats:</h3>
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-6"><div class="col-sm-11 stat"><p>Satoshis given in the last 7 days:</p><div class="col-sm-12"><?php echo $amountWeek;?></div></div></div>
      <div class="col-sm-6"><div class="col-sm-11 col-sm-offset-1 stat"><p>Satoshis given in the last 7 days as referals:</p><div class="col-sm-12"> <?php echo $amountWeekRef;?></div></div></div>
    </div>
    <div class="row">
      <div class="col-sm-6"><div class="col-sm-11 stat"><p>Satoshis given since the beggining of times:</p><div class="col-sm-12"><?php echo $amountBeginning;?></div></div></div>
      <div class="col-sm-6"><div class="col-sm-11 col-sm-offset-1 stat"><p>Satoshis given since the beggining of times (as referals):</p><div class="col-sm-12"><?php echo $amountBeginningRef;?></div></div></div>
    </div>
  </div>
</div>
