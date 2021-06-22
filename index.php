<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetics</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="favicon.jpg" sizes="16x16" type="image/png">
</head>
<body>

<?php

$mysqli = new mysqli("localhost", "unkaes", "unkaes", "unkaes");
?>

<form method="post" action="/addgesprek.php">
	<input type="text" placeholder="Persoon A" name="persoona">
	<input type="text" placeholder="Persoon B" name="persoonb">
	<input type="submit" value="Gesprek Toevoegen">
</form>

<table>
	<tr>
		<td>Persoon A</td>
		<td>Persoon B</td>
		<td>Data</td>
	</tr>
<?php
$stmt = $mysqli->prepare(<<<SQL
	SELECT 
		gesprekid,
		reflectiea.naam AS persoona,
		reflectieb.naam AS persoonb,
		reflectiea.reflectieid AS reflectieaid,
		reflectieb.reflectieid AS reflectiebid,
		gesprek.datum AS datum
	FROM gesprek
	JOIN reflectie AS reflectiea ON gesprek.reflectieaid = reflectiea.reflectieid
	JOIN reflectie AS reflectieb ON gesprek.reflectiebid = reflectieb.reflectieid
	;
SQL);

$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
	$id = $row['gesprekid'];
	$pa = $row['persoona'];
	$pb = $row['persoonb'];;
	$ra = $row['reflectieaid'];
	$rb = $row['reflectiebid'];
	$dt = $row['datum'];
	echo <<<HTML
		<tr>
			<td><a href="/reflectie.php?id={$ra}">{$pa}'s reflectie</a></td>
			<td><a href="/reflectie.php?id={$rb}">{$pb}'s reflectie</a></td>
			<td><a href="/wfglob-graph.php?id={$id}&resolutie=17">focus</a></td>
			<td> <form method="post" action="/deletegesprek.php">
	<input type="hidden" name="id" value="{$id}">
	<input type="submit" value="Gesprek Verwijderen"></form>
	</td>
		</tr>
	HTML;
}
?>
</table>

<h2>Overzicht</h2>
<a href="/wfglob.php">Woordfrequentie Globaal</a>

</body>
</html>