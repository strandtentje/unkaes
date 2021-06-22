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

<h1>Woordfrequentie globaal</h1>
<table>
<?php

$stmt = $mysqli->prepare(<<<SQL
	SELECT woord, acount, bcount 
	FROM (SELECT woord, acount, bcount
		FROM (SELECT 
				woord, 
				COUNT(helfta.gesprekid) AS acount, 
				COUNT(helftb.gesprekid) AS bcount,
				COUNT(helfta.gesprekid) + COUNT(helftb.gesprekid) AS allcount
			FROM woord
			LEFT JOIN gesprek AS helfta ON woord.reflectieid = helfta.reflectieaid
			LEFT JOIN gesprek AS helftb ON woord.reflectieid = helftb.reflectiebid
			GROUP BY woord
			ORDER BY woord) AS woordenlijst
		ORDER BY allcount DESC
		LIMIT 100) AS woordenlijst 
	ORDER BY woord
SQL);

$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
	$woord = $row["woord"];
	$acount = $row["acount"];
	$bcount = $row["bcount"];
	echo <<<HTML
		<tr>
			<td>{$woord}</td>
			<td>{$acount}</td>
			<td>{$bcount}</td>
		</tr>
	HTML;
}
?>
</table>

</body>
</html>