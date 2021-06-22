<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetics</title>
</head>
<body>



<?php

$mysqli = new mysqli("localhost", "unkaes", "unkaes", "unkaes");

$nieuwereflectie = $mysqli->prepare(<<<SQL
	INSERT INTO reflectie(naam, datum)
	VALUES (?, NOW());
SQL);

$nieuwgesprek = $mysqli->prepare(<<<SQL
	INSERT INTO gesprek(reflectieaid, reflectiebid, datum)
	VALUES(?, ?, NOW());
SQL);


$nieuwereflectie->bind_param("s", $naam);
$nieuwgesprek->bind_param("ii", $reflaid, $reflbid);

$naam = htmlspecialchars($_POST["persoona"]);
$nieuwereflectie->execute();
$reflaid = $mysqli->insert_id;

$naam = htmlspecialchars($_POST["persoonb"]);
$nieuwereflectie->execute();
$reflbid = $mysqli->insert_id;

$nieuwgesprek->execute();


header("Location: /");
?>
</table>

</body>
</html>