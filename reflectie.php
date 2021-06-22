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
	SELECT reflectieid, naam, tekst
	FROM reflectie
	WHERE reflectieid = ?
	;
SQL);

$stmt->bind_param("i", $id);
$id = $_GET["id"];

$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()) {
	$sc = htmlspecialchars($row["tekst"]);
	echo <<<HTML
		<h1>{$row["naam"]}'s reflectie</h1>
		<form method="post" action="/reflectieupdate.php?id={$row["reflectieid"]}">
		<textarea rows="20" cols="80" name="tekst">{$sc}</textarea>
		<input type="submit" value="Opslaan">
		</form>
HTML;
} else {
	echo "geen reflectie hier";
}
?>
</table>

</body>
</html>