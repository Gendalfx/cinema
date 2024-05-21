<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/del_style1.css">
	<title>Додавання нового фільму</title>
</head>
<body>
	<h2>Видалення фільму</h2>

	<?php
		$mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
		if ($mysqli->connect_errno) {
			echo "Извините, возникла проблема на сайте";
			exit;
		}
		$s1 = $mysqli->prepare("SELECT * FROM film");
		$s1->execute();
		$res = $s1->get_result();
		if ($res){
			echo "<form method='post'>";
			echo "<select name='id'>";
			echo "<option value=''>Выберите фильм для удаления</option>";
			while ($row = $res->fetch_assoc()) {
				$id = $row['id_film'];
				$name = $row['name'];
				echo "<option value='$id'>$name</option>";
			}
			echo "</select>";
			echo "<br>";
			echo "<input type='submit' name='del' value='Удалить фильм'>";
			echo "</form>";
		}
		else{
			echo "<p>Фильм не найден</p>";
		}
		if (isset($_POST['del'])) {
			$id1=$_POST['id'];
			$s1 = $mysqli->prepare("DELETE FROM film WHERE id_film = ?");
			$s1->bind_param("i", $id1);
			$s1->execute();
			echo "<p>Фильм успешно удален</p>";
		}
		$s1->close();
		$mysqli->close();
	?>

	
	<div class="button-container">
	  <input type="button" value="Додати фільм" onclick="window.location.href='add_film.php'">
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