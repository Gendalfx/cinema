<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/add_style1.css">
    <title>Головна</title>
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
