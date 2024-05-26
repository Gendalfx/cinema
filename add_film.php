<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/add_style1.css">
    <title>Додавання нового фільму</title>
    <style>
        .button-container input {
            background-image: linear-gradient(to right, #f6d365 0%, #fda085 51%, #f6d365 100%);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            color: red;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .button-container input[type="submit"] {
            background-color: #007bff; /* Измененный цвет для кнопки "Відправити" */
            color: white; /* Белый цвет для текста кнопки "Відправити" */
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
    </style>
</head>
<body>
    <h2 style="color: #ff5733;">Додавання нового фільму</h2>
    <?php
        $mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
        if ($mysqli->connect_errno) {
            echo "Вибачте, виникла помилка на сайті";
            exit;
        }

        echo '<form method="post">';
        echo '<label>Назва</label><br>';
        echo '<input type="text" name="name"><br>';
        echo '<label>Опис</label><br>';
        echo '<input type="text" name="description"><br>';
        echo '<div class="button-container">';
        echo '<input type="submit" name="sub" value="Відправити">';
        echo '</div>';
        echo '</form>';

        if(isset($_POST['sub'])){
            $name=$_POST['name'];
            $description=$_POST['description'];
            $s1 = $mysqli->prepare("INSERT INTO film (name, description) VALUES (?, ?)");
            $s1->bind_param("ss", $name, $description);
            $s1->execute();
            echo "<p>Дані успішно додані</p>";
        }
        $mysqli->close();
    ?>
    
    <div class="button-container">
        <input type="button" value="Видалити фільм" onclick="window.location.href='del_film.php'">
        <input type="button" value="Головна" onclick="window.location.href='main.php'">
        <input type="button" value="Редагувати фільм" onclick="window.location.href='edit_film.php'">
    </div>

    <h2 style="color: #ff5733;">Таблиця філмів</h2>
    <table>
        <tr>
            <th class="start">ID</th>
            <th>Назва фільму</th>
            <th class="end">Опис</th>
        </tr>
        <?php
            // Подключение к базе данных
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Cinema_kurs1";
    
            // Создание подключения
            $conn = new mysqli($servername, $username, $password, $dbname);
    
            // Проверка соединения
            if ($conn->connect_error) {
                die("Ошибка подключения: " . $conn->connect_error);
            }
            $sql = "SELECT id_film, name, description FROM film";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                // Вывод данных каждой строки
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
