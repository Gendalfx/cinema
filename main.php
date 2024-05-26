<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/add_style1.css">
    <title>Головна</title>
    
    <style>
        .button-container input {
              background-image: linear-gradient(to right, #f6d365 0%, #fda085 51%, #f6d365 100%);
                background-size: 200% 200%;
    animation: gradientShift 3s ease infinite;
    color: red;
        }
        .button-container input:hover {
    transform: scale(1.05);
    animation: gradientAnimation 5s ease infinite;
                transition: background-position 0.5s, transform 0.5s;

}
@keyframes gradientShift {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

h2 {
    color: #ff5733; /* измененный цвет для заголовков */
}
</style>
</head>
<body>
    <h2>Фільми</h2>
    <div class="button-container">
      <input type="button" value="Додати фільми" onclick="window.location.href='add_film.php'">
      <input type="button" value="Видалити фільми" onclick="window.location.href='del_film.php'">
      <input type="button" value="Редагувати фільми" onclick="window.location.href='edit_film.php'">
      <input type="button" value="Назад" onclick="window.location.href='index.php'">
    </div><br><br>
    
    <h2>Таблиця фільмів</h2>
    <table>
        <tr>
            <th class="start">ID</th>
            <th>Назва фільму</th>
            <th class="end">Опис</th>
        </tr>
        
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Cinema_kurs1";
    
            $conn = new mysqli($servername, $username, $password, $dbname);
    
            if ($conn->connect_error) {
                die("Помилка підключення: " . $conn->connect_error);
            }
            $sql = "SELECT id_film, name, description FROM film";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_film"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>0 результатів</td></tr>";
            }
            $conn->close();
        ?>
    </table>
</body>
</html>
