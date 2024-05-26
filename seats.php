<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отображение мест</title>
    <style>
        /* Общие стили для таблицы и ее элементов */
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        /* Стили для строк с четными и нечетными номерами */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        /* Стили для ячеек внутри таблицы */
        td {
            color: #555;
        }

        /* Стили для заголовка */
        h2 {
            text-align: center;
            font-family: "Arial Black", sans-serif;
            color: #333;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.2);
            letter-spacing: 2px;
        }
    </style>
</head>
<body>

<h2>Всі Місця</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Номер залу</th>
        <th>Ряд</th>
        <th>Місце</th>
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
