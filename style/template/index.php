<!DOCTYPE html>
<html>
<head>
  <title><?php echo $settings["title"]?></title>
  <link rel="stylesheet" href="style/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="style/css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="style/css/myCssClass.css" media="screen">
  <style>
  .color-title{
    color:<?php echo $settings["title_color"];?>;
  }
  .color-subtitle{
    color:<?php echo $settings["subtitle_color"];?>;
  }
  .color-background-body{
    <?php if($settings["background_image_selected"]=="true") {?>
      background-image: url(<?php echo $settings["background_image"];?>);
      <?php } else{ ?>
    background-color:<?php echo $settings["background_color"];
    }?>;
  }
  </style>
</head>
<body class="color-background-body">
  <div class ="container-fluid">
    <h1 class="text-center color-title"><?php echo $settings["title"];?></h1>
    <h3 class="text-center color-subtitle"><?php echo $settings["subtitle"];?></h3>
    <div class="row">
      <div class="col-sm-3 col-md-2 hidden-xs">
        <!-- Insert your left vertical google ad Code below this comment-->
        <?php echo $settings["left_vertical_ad"];?>
  </div>
    <div class="col-sm-6 col-md-8 text-center">
      <div class="top-banner">
        <!-- Insert your top horizontal google ad Code below this comment (Recommended size 728x90)-->
        <?php echo $settings["top_horizontal_ad"];?>
    </div>


      <div><strong><p class="alert alert-info">Your possible rewards <?php echo $rewards["reward_list_html"]; ?></p></strong></div>
      <div>
        <strong><p>Earning bitcoins is simple:</p></strong>
      </div>
      <?php echo $view['main']['result_html']; ?>
      <?php echo $view['main']['ref_link']; ?>
      <!-- Insert your second horizontal google ad Code below this comment (Recommended size 320x100)-->
      <?php echo $settings["middle_horizontal_ad"]; ?>
      <form method="Post">
        <div >
          <div><label>Insert your email or BTC address:</label>
            <input name="username" id="username" class="form-control text-center" type="text" placeholder="Enter your email or BTC address"></div>
          </div><br>
          <div>
            <div class="form-group"><label>Solve the captcha:</label>

              <center class="captcha"><script type="text/javascript" src="http://api.solvemedia.com/papi/challenge.script?k=<?php echo $settings['solvemedia_challenge_key']?>"></script></center></div>
              </div>
            <div>
              <div>
                <button class="btn btn-<?php echo $settings["button_background"]; ?>" type="submit"><?php echo $settings["submit_button_text"]; ?></button>
              </div>
            </div>
          </form>
          <br>
          <!-- Insert your rectangle google ad Code below this comment (Recommended size 300x250)-->
          <?php echo $settings["bottom_horizontal_ad"];?>
          <div id="description">
            <strong><p><?php echo $settings["main_content"];?></p></strong>
          </div>
      </div>
      <div class="col-sm-3 col-md-2 hidden-xs zeta">
        <!-- Insert your right vertical google ad Code below this comment-->
        <?php echo $settings["right_vertical_ad"];?>
    </div>
  </div>
  <footer><strong><p class="text-center">Copyright &#169; 2015 <?php echo $settings["title"];?> <a href=<?php echo $settings["contact_mail"];?>>Contact us</a></p></strong></footer>
</div>
</body>
</html>
