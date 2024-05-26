<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Реєстрація</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .message {
      color: green;
      font-size: 18px;
      text-align: center;
      margin-top: 20px;
    }
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

$message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
    if ($mysqli->connect_errno) {
        $error_message = "Вибачте, виникла помилка на сайті";
    } else {
        // Получение данных из формы
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Проверка, существует ли пользователь с таким именем
        $stmt_check = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            $error_message = "Користувач з таким іменем вже існує";
            $stmt_check->close();
        } else {
            $stmt_check->close();

            // Хеширование пароля
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // SQL-запрос для добавления нового пользователя
            $stmt_insert = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt_insert->bind_param("ss", $username, $hashed_password);
            if ($stmt_insert->execute()) {
                $message = "Новий користувач успішно зареєстрований";
            } else {
                $error_message = "Помилка: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        }
        // Закрытие соединения с базой данных
        $mysqli->close();
    }
}
?>

  <!-- ICONS -->
  <svg id="svg-source" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="position: absolute">
    <!-- Icons omitted for brevity -->
  </svg>
  <!-- ICONS -->

  <div class="wrapper">
    <div class="header">
      <h3 class="Reg">Registration</h3>
      <div class="button">
        <a href="login.php">Sign In</a>
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
        <input type="submit" value="Реєстрація" />
      </div>
    </form>
    <?php if (!empty($message)): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <?php if (!empty($error_message)): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
