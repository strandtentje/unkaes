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
	INSERT INTO gesprek(persoona, persoonb, datum)
	VALUES(?, ?, NOW());
SQL);

$persoona = htmlspecialchars($_POST["persoona"]);
$persoonb = htmlspecialchars($_POST["persoonb"]);

$stmt->bind_param("ss", $persoona, $persoonb);
$stmt->execute();

header("Location: /");
?>
</table>

</body>
</html>