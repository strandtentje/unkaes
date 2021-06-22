<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetics</title>
</head>
<body>



<?php

$mysqli = new mysqli("localhost", "unkaes", "unkaes", "unkaes");

$verwijdergesprek = $mysqli->prepare(<<<SQL
	DELETE from gesprek where gesprekid=?;
SQL);


$verwijdergesprek->bind_param("i", $id);

$id = $_POST["id"];

$verwijdergesprek->execute();


header("Location: /");
?>
</table>

</body>
</html>