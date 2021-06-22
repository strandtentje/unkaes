<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetic</title>
</head>
<body>



<?php

$mysqli = new mysqli("localhost", "unkaes", "unkaes", "unkaes");

$stmt = $mysqli->prepare(<<<SQL
	UPDATE reflectie SET tekst = ? WHERE reflectieid = ?;
	;
SQL);

$stmt->bind_param("si", $tekst, $id);
$tekst = $_POST["tekst"];
$id = $_GET["id"];

$stmt->execute();

$stmt = $mysqli->prepare(<<<SQL
	DELETE FROM woord WHERE reflectieid = ?;
SQL);

$stmt->bind_param("i", $id);
$id = $_GET["id"];

$stmt->execute();

$stmt = $mysqli->prepare(<<<SQL
	INSERT INTO woord(reflectieid, woord)
	VALUES(?, ?);
SQL);

$stmt->bind_param("is", $id, $woord);
$id = $_GET["id"];

$split = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $tekst, -1, PREG_SPLIT_NO_EMPTY);

foreach ($split as $woord) {
	$stmt->execute();	
}

header("Location: /");	
?>
</table>

</body>
</html>