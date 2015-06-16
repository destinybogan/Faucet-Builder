<!DOCTYPE html>
<html>
<head>
  <title>Admin: <?php echo $settings["title"]?></title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="../style/css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="../style/css/myCssClass.css" media="screen">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#show-pass-change").click(function(){
        $("#change-pass").toggle(500);
    });
});
</script>
</head>
<body>
  <div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 text-center">
    <h1 class="text-center">Admin Panel</h1>
    <div class="col-sm-6 text-left">
      <a href="#" id="show-pass-change">Change Password</a>
    </div>

    <div class="col sm-6 text-right">
    <form method="post" id="logout_form">
    <input type="hidden" name="action" value="logout" />
    <a href="#" onclick="document.getElementById('logout_form').submit(); return false;">Logout</a>
</form>
</div>

<div>
  <?php echo $view["admin_message_html"]; ?>
  <div id="change-pass" class="form-group border initially-hidden">
    <form method="POST">
    <label for="inputPassword" class="control-label">Password</label>
    <div class="form-group">
      <input type="password" data-minlength="6" class="form-control" id="new_password" name="new_password"  placeholder="Password" required>
      <span class="help-block">Minimum of 6 characters</span>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-match="#input_password" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
      <div class="help-block with-errors"></div>
    </div>
    <button type="submit" class="btn btn-primary">Change my password</button>
  </form>
  </div>

    <form role="form" data-toggle="validator" method="POST">
      <div class="form-group text-left">



        <div class="form-group">
          <label for="name">Faucet Name:</label>
          <input type="text" value="<?php echo $settings["title"]?>" class="form-control" id="title" name="title" data-error="Required field" required>
          <span class="help-block with-errors">The name of your Faucet</span>
        </div>
        <div class="form-group">
          <label for="subtitle">Faucet Subtitle:</label>
          <input type="text" value="<?php echo $settings["subtitle"]?>" class="form-control" id="subtitle" name="subtitle">
        </div>
        <div class="form-group">
          <label for="desc1">Faucet Description 1:</label>
          <textarea class="form-control" rows="3" id="description_1" name="description_1"><?php echo $settings["description_1"]?></textarea>
        </div>
        <div class="form-group">
          <label for="desc2">Faucet Description 2:</label>
          <textarea class="form-control" rows="3" id="description_2" name="description_2"><?php echo $settings["description_2"]?></textarea>
        </div>
        <div class="form-group">
          <label for="rewards">Rewards:</label>
          <input type="text" value="<?php echo $settings["rewards"]?>" class="form-control" id="rewards" name="rewards" data-error="Required field" required>
          <span class="help-block with-errors">Input the rewards and the weight of each possible prize using the format <i>reward</i>*<i>weight</i> sepparated by commas. Units are in Satoshis.<br>For example: 100*2, 200*1 means that the chances of a user winning 100 satoshis are double than winning 200 Satoshis.</span>
        </div>
        <div class="form-group">
          <label for="ref_perc">Referral Percentage:</label>
          <input type="number" min="0" value="<?php echo $settings["referral_percentage"]?>" class="form-control" id="referral_percentage" name="referral_percentage" data-error="Insert a valid number" numeric>
          <span class="help-block with-errors">The percentage of the claim that users take by promoting your Faucet</span>
        </div>
        <div class="form-group">
          <label for="timer">Timer:</label>
          <input type="number" min="0" value="<?php echo $settings["timer"]?>" class="form-control" id="timer" name="timer" data-error="Insert a valid number" numeric>
          <span class="help-block with-errors">The time interval for your users to redeem</span>
        </div>
        <div class="form-group">
          <label for="c_key">Solvemedia Challenge Key:</label>
          <input type="text" value="<?php echo $settings["solvemedia_challenge_key"]?>" class="form-control" id="solvemedia_challenge_key" name="solvemedia_challenge_key">
        </div>
        <div class="form-group">
          <label for="v_key">Solvemedia Verification Key:</label>
          <input type="text" value="<?php echo $settings["solvemedia_verification_key"]?>" class="form-control" id="solvemedia_verification_key" name="solvemedia_verification_key">
        </div>
        <div class="form-group">
          <label for="xapo_app">Xapo App:</label>
          <input type="text" value="<?php echo $settings["xapo_app_id"]?>" class="form-control" id="xapo_app_id" name="xapo_app_id">
        </div>
        <div class="form-group">
          <label for="secret_key">Xapo Secret Key:</label>
          <input type="text" value="<?php echo $settings["xapo_secret_key"]?>" class="form-control" id="xapo_secret_key" name="xapo_secret_key" >
        </div>
        <div class="form-group">
          <label for="top_horizontal_ad">Top horizontal Ad script:</label>
          <textarea class="form-control" rows="3" id="top_horizontal_ad" name="top_horizontal_ad"><?php echo $settings["top_horizontal_ad"];?></textarea>
          <span class="help-block with-errors">Recommended size 728x90</span>
        </div>
        <div class="form-group">
          <label for="left_vertical_ad">Left vertical Ad script:</label>
          <textarea class="form-control" rows="3" id="left_vertical_ad" name="left_vertical_ad"><?php echo $settings["left_vertical_ad"];?></textarea>
        </div>
        <div class="form-group">
          <label for="right_vertical_ad">Right vertical Ad script:</label>
          <textarea class="form-control" rows="3" id="right_vertical_ad" name="right_vertical_ad"><?php echo $settings["right_vertical_ad"];?></textarea>
        </div>
        <div class="form-group">
          <label for="middle_horizontal_ad">Middle horizontal Ad script:</label>
          <textarea class="form-control" rows="3" id="middle_horizontal_ad" name="middle_horizontal_ad"><?php echo $settings["middle_horizontal_ad"];?></textarea>
          <span class="help-block with-errors">Recommended size 320x100</span>
        </div>
        <div class="form-group">
          <label for="bottom_horizontal_ad">Bottom horizontal Ad script:</label>
          <textarea class="form-control" rows="3" id="bottom_horizontal_ad" name="bottom_horizontal_ad"><?php echo $settings["bottom_horizontal_ad"];?></textarea>
          <span class="help-block with-errors">Recommended size 300x250</span>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="../style/validator/dist/validator.min.js"></script>
  <script src="http://platform.twitter.com/widgets.js"></script>
  <script src="../validator/assets/js/application.js"></script>

</body>
</html>
