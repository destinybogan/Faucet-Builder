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
<?php echo $view["admin_message_html"]; ?>

<div id="change-pass" class="form-group border initially-hidden">
    <form method="POST">
    <label for="inputPassword" class="control-label">New Password</label>
    <div class="form-group">
      <input type="password" data-minlength="6" class="form-control" id="new_password" name="new_password"  placeholder="new password" required>
      <span class="help-block">Minimum of 6 characters</span>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-match="#input_password" data-match-error="Whoops, these don't match" placeholder="confirm" required>
      <div class="help-block with-errors"></div>
    </div>
    <button type="submit" class="btn btn-primary">Change my password</button>
  </form>
  </div>


<div role="tabpanel">
  <ul class="nav nav-tabs">
    <li><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
    <li><a href="#design" aria-controls="design" role="tab" data-toggle="tab">Design</a></li>
    <li><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Stats</a></li>
  </ul>
  <form method="post">
  <div class="tab-content">

  <div role="tabpanel" class="tab-pane active" id="general">
    <?php require 'template/general.php';?>
  </div>
  <div role="tabpanel" class="tab-pane" id="design">
    <?php require 'template/design.php';?>
  </div>
  <div role="tabpanel" class="tab-pane" id="password">
    <?php require "template/stats.php"; ?>
  </div>
</div>
<button id="saveButton" type="submit" class="btn btn-default">Save Changes</button>
</form>
</div>



  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="../style/validator/dist/validator.min.js"></script>
  <script src="http://platform.twitter.com/widgets.js"></script>
  <script src="../validator/assets/js/application.js"></script>

</body>
</html>
