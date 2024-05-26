<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./css/edit_style1.css">
    <title>Редагування квитків</title>
    
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
            color: white; /* Белый цвет для кнопки "Редагувати" */
            background-color: #007bff; /* Измененный цвет для кнопки "Редагувати" */
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
    <h2 style="color: #ff5733;">Редагування квитків</h2>

    <?php
        $mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
        if ($mysqli->connect_errno) {
            echo "Вибачте, виникла помилка на сайті";
            exit;
        }

        $s1 = $mysqli->prepare("SELECT * FROM tickets");
        $s1->execute();
        $res = $s1->get_result();

        if ($res) {
            echo "<form method='post'>";
            echo "<select name='id'>";
            echo "<option value=''>Оберіть квиток для редагування</option>";
            while ($row = $res->fetch_assoc()) {
                $id = $row['id_seats'];
                echo "<option value='$id'>$id</option>";
            }
            echo "</select>";
            echo "<br>";
            echo "<div class='button-container'>";
            echo "<input type='submit' name='sel' value='Обрати квиток для редагування'>";
            echo "</div>";
            echo "</form>";
        } else {
            echo "<p>Квитків не знайдено</p>";
        }

        if (isset($_POST['sel'])) {
            $id1 = $_POST['id'];
            $s1 = $mysqli->prepare("SELECT * FROM tickets WHERE id_seats = ?");
            $s1->bind_param("i", $id1);
            $s1->execute();
            $res1 = $s1->get_result();
            $res = $res1->fetch_assoc();

            echo '<form method="post">';
            echo '<input type="hidden" name="id1" value="' . $res['id_seats'] . '">';
            echo '<br><label>Продано (1 - Так, 0 - Ні)</label><br>';
            echo '<input type="text" name="is_sold" value="' . $res['is_sold'] . '"><br><br>';
            echo '<label>Ціна</label><br>';
            echo '<input type="text" name="cost" value="' . $res['cost'] . '"><br><br>';
            echo '<div class="button-container">';
            echo '<input type="submit" name="update" value="Редагувати">';
            echo '</div>';
            echo '</form>';
        }

        if (isset($_POST['update'])) {
            $id2 = $_POST['id1'];
            $is_sold = $_POST['is_sold'];
            $cost = $_POST['cost'];
            $s1 = $mysqli->prepare("UPDATE tickets SET is_sold = ?, cost = ? WHERE id_seats = ?");
            $s1->bind_param("iii", $is_sold, $cost, $id2);
            $s1->execute();
            echo "<p>Інформацію про квиток оновлено</p>";
        }

        $s1->close();
        $mysqli->close();
    ?>

    <div class="button-container">
        
        <input type="button" value="Головна" onclick="window.location.href='index.php'">
        
    </div>

    <h2 style="color: #ff5733;">Таблиця квитків</h2>
    <table>
        <tr>
            <th class="start">ID місця</th>
            <th>Продано</th>
            <th class="end">Ціна</th>
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
            $sql = "SELECT id_seats, is_sold, cost FROM tickets";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_seats"] . "</td>";
                    echo "<td>" . $row["is_sold"] . "</td>";
                    echo "<td>" . $row["cost"] . "</td>";
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
