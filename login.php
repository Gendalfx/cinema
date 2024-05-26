<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .error-message {
      color: red;
      font-size: 18px;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
<?php
session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
    if ($mysqli->connect_errno) {
        echo "Вибачте, виникла помилка на сайті";
        exit;
    }

    // Получение данных из формы
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка существующего пользователя
    $stmt_check = $mysqli->prepare("SELECT password FROM users WHERE username = ?");
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $stored_password = $row['password'];

        if (password_verify($password, $stored_password)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Неправильний пароль";
        }
    } else {
        $error_message = "Користувача з таким іменем не існує";
    }

    $stmt_check->close();
    $mysqli->close();
}
?>

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
    <form method="post" action="">
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
    <?php if (!empty($error_message)): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
