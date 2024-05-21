<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Реєстрація</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();

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

    // Проверка, существует ли пользователь с таким именем
    $sql_check = "SELECT * FROM users WHERE username='$username'";
    $result_check = $mysqli->query($sql_check);
    if ($result_check->num_rows > 0) {
        echo "Користувач з таким іменем вже існує";
        exit;
    }

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL-запрос для добавления нового пользователя
    $sql_insert = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($mysqli->query($sql_insert) === TRUE) {
        echo "Новий користувач успішно зареєстрований";
    } else {
        echo "Помилка: " . $sql_insert . "<br>" . $mysqli->error;
    }

    // Закрытие соединения с базой данных
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
    <h3 class="Reg">Registration</h3>
      <div class="button">
        <a href="login.php">Sign In</a>
      </div>
    </div>
    <div class="clear"></div>
    <form method="post" action="login.php">
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
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
