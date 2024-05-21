<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/edit_style1.css">
	<title>Редагування фільму</title>
</head>
<body>
	<h2>Редагування фільму</h2>

	<?php
$mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
if ($mysqli->connect_errno) {
    echo "Вибачте, виникла помилка на сайті";
    exit;
}

$s1 = $mysqli->prepare("SELECT * FROM film");
$s1->execute();
$res = $s1->get_result();

if ($res) {
	echo "<form method='post'>";
	echo "<select name='id'>";
	echo "<option value=''>Оберіть фільм для редагування</option>";
	while ($row = $res->fetch_assoc()) {
		$id = $row['id_film'];
		$name = $row['name'];
		echo "<option value='$id'>$name</option>";
	}
	echo "</select>";
	echo "<br>";
	echo "<input type='submit' name='sel' value='Обрати фільм для редагування'>";
	echo "</form>";
} else {
    echo "<p>Фільмів не знайдено</p>";
}

if (isset($_POST['sel'])) {
    $id1 = $_POST['id'];
    $s1 = $mysqli->prepare("SELECT * FROM film WHERE id_film = ?");
    $s1->bind_param("i", $id1);
    $s1->execute();
    $res1 = $s1->get_result();
    $res = $res1->fetch_assoc();

    echo '<form method="post">';
    echo '<input type="hidden" name="id1" value="' . $res['id_film'] . '">';
    echo '<br><label>Назва</label><br>';
    echo '<input type="text" name="name" value="' . $res['name'] . '"><br><br>';
    echo '<label>Опис</label><br>';
    echo '<textarea name="description">' . $res['description'] . '</textarea><br><br>';
    echo '<input type="submit" name="update" value="Редагувати">';
    echo '</form>';
}

if (isset($_POST['update'])) {
    $id2 = $_POST['id1'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $s1 = $mysqli->prepare("UPDATE film SET name = ?, description = ? WHERE id_film = ?");
    $s1->bind_param("ssi", $name, $description, $id2);
    $s1->execute();
    echo "<p>Інформацію про фільм оновлено</p>";
}

$s1->close();
$mysqli->close();
?>


	<div class="button-container">
	  <input type="button" value="Додати фільм" onclick="window.location.href='add_film.php'">
	  <input type="button" value="Головна" onclick="window.location.href='main.php'">
	  <input type="button" value="Видалити фільм" onclick="window.location.href='del_film.php'">
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