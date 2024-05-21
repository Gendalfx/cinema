<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отображение мест</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Все места</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Номер зала</th>
        <th>Ряд</th>
        <th>Место</th>
    </tr>
    
    <?php
    $mysqli = new mysqli("localhost", "root", "", "Cinema_kurs1");
    if ($mysqli->connect_errno) {
        echo "Вибачте, виникла помилка на сайті";
        exit;
    }

    $sql = "SELECT * FROM seats";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_seats"] . "</td>";
            echo "<td>" . $row["id_hall"] . "</td>";
            echo "<td>" . $row["row"] . "</td>";
            echo "<td>" . $row["seat"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>0 результатов</td></tr>";
    }

    $mysqli->close();
    ?>
</table>

</body>
</html>
