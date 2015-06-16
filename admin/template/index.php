<!DOCTYPE html>
<html>
<head>
  <title>Admin: <?php echo $settings["title"]?></title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="../style/css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="../style/css/myCssClass.css" media="screen">

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#lbl-change-password").click(function(){
        $("#change-pass").toggle(500);
    });
});

$(document).ready(function(){
    $("#lbl-change-xapo-keys").click(function(){
        $("#change-xapo-keys").toggle(500);
    });
});
</script>

<style>
img{
  margin: 5px;
  border-style: solid;
  border-width: 1px;
}

</style>



</head>
<body>
  <div id="flags" class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 text-right">

  </div>
  <div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 text-center">
    <h1 id="lbl-admin-panel" class="text-center">Admin Panel</h1>
    <div class="col-sm-6 text-left">
      <a href="#" id="lbl-change-password">Change Password</a>
    </div>


    <div class="col sm-6 text-right">
    <form method="post" id="logout_form">
    <input type="hidden" name="action" value="logout" />
    <a id="lbl-logout" href="#" onclick="document.getElementById('logout_form').submit(); return false;">Logout</a>
</form>
</div>

<?php echo $view["admin_message_html"]; ?>

<div id="change-pass" class="form-group border initially-hidden">
    <form method="POST" data-toggle="validator">
    <label id="lbl-new-password-title" for="new_password" class="control-label">New Password</label>
    <div class="form-group">
      <input type="password" data-minlength="6" class="form-control" id="new_password" name="new_password"  placeholder="new password" required>
      <span id="lbl-min-password" class="help-block">Minimum of 6 characters</span>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-match="#new_password" data-match-error="Whoops, these don't match" placeholder="confirm" required>
      <div class="help-block with-errors"></div>
    </div>
    <button id="btn-change-password" type="submit" class="btn btn-primary">Change my password</button>
  </form>
  </div>

  <div class="col-sm-12 text-left">
    <a href="#" id="lbl-change-xapo-keys">Change Xapo Keys</a>
  </div>

  <div id="change-xapo-keys" class="form-group border initially-hidden">
      <form method="POST" data-toggle="validator">
      <label id="lbl-new-xapo-app-id" for="new_xapo_app_id" class="control-label">Xapo App ID:</label>
      <div class="form-group">
        <input class="form-control" id="new_xapo_app_id" name="new_xapo_app_id"  placeholder="Your Xapo App ID" required>
      </div>
      <div class="form-group">
        <label id="lbl-new-xapo-secret-key" for="new_xapo_secret_key" class="control-label">Xapo App Secret:</label>
        <input class="form-control" id="new_xapo_secret_key" name="new_xapo_secret_key" placeholder="Your Xapo App Secret Key" required>
      </div>
      <button id="btn-change-keys" type="submit" class="btn btn-primary">Change my keys</button>
    </form>
    </div>


<div role="tabpanel">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#general" id="lbl-tab-general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
    <li><a href="#design" id="lbl-tab-design" aria-controls="design" role="tab" data-toggle="tab">Design</a></li>
    <li><a href="#stats" id="lbl-tab-stats" aria-controls="stats" role="tab" data-toggle="tab">Stats</a></li>
  </ul>
  <form method="post" id="form" data-toggle="validator">
  <div class="tab-content">

  <div role="tabpanel" class="tab-pane active" id="general">
    <?php require 'template/general.php';?>
  </div>
  <div role="tabpanel" class="tab-pane" id="design">
    <?php require 'template/design.php';?>
  </div>
  <div role="tabpanel" class="tab-pane" id="stats">
    <?php require 'template/stats.php'; ?>
  </div>
</div>
<button id="btn-save-changes" type="submit" class="btn btn-default">Save Changes</button>
</form>
</div>
</div>
<script src="http://52.10.94.148/landing/language.js"></script>

<script>
loadFlags();
</script>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="../style/validator/dist/validator.min.js"></script>
  <script src="http://platform.twitter.com/widgets.js"></script>
  <script src="../validator/assets/js/application.js"></script>

</body>
</html>
