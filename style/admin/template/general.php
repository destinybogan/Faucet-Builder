<h3 class="text-center">General Settings:</h3>
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
      <label for="main_content">Faucet Main Content:</label>
      <textarea class="form-control" rows="3" id="main_content" name="main_content"><?php echo $settings["main_content"]?></textarea>
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
  </div>
