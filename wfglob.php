<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetics</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	FROM (SELECT woordenlijst.woord, acount, bcount
		FROM (SELECT 
				woord, 
				COUNT(helfta.gesprekid) * LENGTH(woord) AS acount, 
				COUNT(helftb.gesprekid) * LENGTH(woord) AS bcount,
				COUNT(helfta.gesprekid) * LENGTH(woord) + COUNT(helftb.gesprekid) * LENGTH(woord) AS allcount
			FROM woord
			LEFT JOIN gesprek AS helfta ON woord.reflectieid = helfta.reflectieaid
			LEFT JOIN gesprek AS helftb ON woord.reflectieid = helftb.reflectiebid
			GROUP BY woord
			ORDER BY woord) AS woordenlijst
		LEFT JOIN verbodenwoord ON woordenlijst.woord = verbodenwoord.woord		
        WHERE verbodenwoordid IS NULL
		ORDER BY allcount DESC
		LIMIT 50) AS woordenlijst 
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