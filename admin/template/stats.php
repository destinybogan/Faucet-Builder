<?php

$amountWeekRow = $sql->query(query_last_week())->fetch();

$amountWeek = $amountWeekRow["value"];

$amountWeekRefRow = $sql->query(query_last_week_referals())->fetch();
$amountWeekRef = $amountWeekRefRow["value"];

$amountBeginningRow = $sql->query(query_since_beginning())->fetch();
$amountBeginning = $amountBeginningRow["value"];

$amountBeginningRefRow = $sql->query(query_since_beginning_referals())->fetch();
$amountBeginningRef = $amountBeginningRefRow["value"];

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
  <h3 id="lbl-your-stats" class="text-center">Your stats:</h3>
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-6"><div class="col-sm-11 stat"><p id="lbl-satoshis-7-days">Satoshis given in the last 7 days:</p><div class="col-sm-12"><?php echo $amountWeek;?></div></div></div>
      <div class="col-sm-6"><div class="col-sm-11 col-sm-offset-1 stat"><p id="lbl-satoshis-7-days-as-referals">Satoshis given in the last 7 days as referals:</p><div class="col-sm-12"> <?php echo $amountWeekRef;?></div></div></div>
    </div>
    <div class="row">
      <div class="col-sm-6"><div class="col-sm-11 stat"><p id="lbl-satoshis-beggining">Satoshis given since the beggining of times:</p><div class="col-sm-12"><?php echo $amountBeginning;?></div></div></div>
      <div class="col-sm-6"><div class="col-sm-11 col-sm-offset-1 stat"><p id="lbl-satoshis-beggining-referrals">Satoshis given since the beggining of times (as referals):</p><div class="col-sm-12"><?php echo $amountBeginningRef;?></div></div></div>
    </div>
  </div>
</div>
