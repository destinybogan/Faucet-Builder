<!DOCTYPE html>
<html>
<head>
  <title>Admin panel</title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="../style/css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="../style/css/myCssClass.css" media="screen">

</head>
<body>
  <div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 text-left">
    <h1 class="text-center">Admin Panel</h1>

    <?php echo $view["admin_message_html"]; ?>

    <form role="form" method="POST">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox">
         <label>
           <input type="checkbox" value="on" id="remember" name="remember" > Remember me
         </label>
       </div>
       <button type="submit" class="btn btn-default">Login</button>
     </div>
    </form>
  </div>
</body>
</html>
