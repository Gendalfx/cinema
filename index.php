<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/index_style.css">
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


        </style>
</head>
</head>
<body>
	<div class="button-container">
	  
	  <input type="button" value="Фільми" onclick="window.location.href='main.php'">
	  <input type="button" value="Місця" onclick="window.location.href='seats.php'">
	  <input type="button" value="Квитки" onclick="window.location.href='edit_tickets.php'">
	</div>
</body>
</html>