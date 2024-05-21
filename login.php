<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- ICONS -->
  <svg id="svg-source" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="position: absolute">
    <!-- Icons omitted for brevity -->
  </svg>
  <!-- ICONS -->

  <div class="wrapper">
    <div class="header">
      <h3 class="sign-in">Sign in</h3>
      <div class="button">
        <a href="reg.php">Register</a>
      </div>
    </div>
    <div class="clear"></div>
    <form method="post" action="reg.php">
      <div>
        <label class="user" for="username">
          <svg viewBox="0 0 32 32">
            <g filter="">
              <use xlink:href="#man-people-user"></use>
            </g>
          </svg>
        </label>
        <input class="user-input" type="text" name="username" id="username" placeholder="My name is" required />
      </div>
      <div>
        <label class="lock" for="password">
          <svg viewBox="0 0 32 32">
            <g filter="">
              <use xlink:href="#lock-locker"></use>
            </g>
          </svg>
        </label>
        <input type="password" name="password" id="password" placeholder="Password" required />
      </div>
      <div>
        <input type="submit" value="Sign in" />
      </div>
      <div class="radio-check">
        <input type="radio" class="radio-no" id="no" name="remember" value="no" checked>
        <label for="no"><i class="fa fa-times"></i></label>
        <input type="radio" class="radio-yes" id="yes" name="remember" value="yes">
        <label for="yes"><i class="fa fa-check"></i></label>
        <span class="switch-selection"></span>
      </div>
      <span class="check-label">Remember me</span>
      <span class="forgot-label">Lost your password?</span>
      <div class="clear"></div>
    </form>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
