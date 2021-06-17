<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetic</title>
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
		<td>Reflektie A</td>
		<td>Reflektie B</td>
	</tr>
<?php
$stmt = $mysqli->prepare(<<<SQL
	SELECT 
		gesprekid, 
		persoona, 
		persoonb, 
		reflectieaid,
		reflectiebid,
		datum
	FROM gesprek;
SQL);

$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
	$id = $row['gesprekid'];
	$pa = $row['persoona'];
	$pb = $row['persoonb'];
	$ra = $row['reflectieaid'];
	$rb = $row['reflectiebid'];
	$dt = $row['datum'];
	echo <<<HTML
		<tr>
			<td>{$pa}</td>
			<td>{$pb}</td>
			<td><a href=\"/refliv.php?={$ra}\">Invullen</a></td>
			<td><a href=\"/refliv.php?={$rb}\">Invullen</a></td>
		</tr>
	HTML;
}
?>
</table>

</body>
</html>