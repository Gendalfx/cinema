<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/add_style1.css">
	<title>Додавання нового фільму</title>
</head>
<body>
	<h2>Додавання нового фільму</h2>
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
        echo '<input type="submit" name="sub" value="Відправити">';
        echo "</form>";

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

	<h2>Таблиця філмів</h2>
	<table>
		<tr>
			<th class = "start">ID</th>
			<th>Назва фільму</th>
			<th class = "end">Опис</th>
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
				echo "<tr><td colspan='4'>0 результатов</td></tr>";
			}
			$conn->close();
		?>
	</table>

</body>
</html>