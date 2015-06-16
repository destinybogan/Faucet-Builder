<?php
if($settings["password_set"]=='0'){
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin: <?php echo $settings["title"]?></title>
  <link rel="stylesheet" href="style/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="style/css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="style/css/myCssClass.css" media="screen">

</head>
<body>
  <div class="text-center">
  <h1>Create your password:</h1>
</div>
    <div class="form-group col-sm-6 col-sm-offset-3 text-left">
      <form data-toggle="validator" role="form" method="POST">
      <label for="inputPassword" class="control-label">Password</label>
      <div class="form-group col-sm-12">
        <input type="password" data-minlength="6" class="form-control" id="new_password" name="new_password" placeholder="Password" required>
        <span class="help-block">Minimum of 6 characters</span>
      </div>
      <div class="form-group col-sm-12">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-match="#new_password" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
        <div class="help-block with-errors"></div>
      </div>

    <div class="form-group">
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="style/validator/dist/validator.min.js"></script>
    <script src="http://platform.twitter.com/widgets.js"></script>
    <script src="style/validator/assets/js/application.js"></script>


</body>
</html>

<?php
}
else{
  echo "<p>Access denied</p>";
}
?>
