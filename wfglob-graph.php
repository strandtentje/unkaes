<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Unknown Aesthetics</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<script type="text/javascript" src="/flotr2.min.js"></script>

<?php

$mysqli = new mysqli("localhost", "unkaes", "unkaes", "unkaes");
?>

<h1>Woordfrequentie globaal</h1>
<div id="grafiekbevatter"></div>
<script type="text/javascript">
	var tmpa = [];
	var tmpb = [];
	var adatas = [];
	var bdatas = [];
	var i = 0;

<?php


$stmt = $mysqli->prepare(<<<SQL
select fqa as acount, fqb as bcount
from (   
    select 
		aw.woord as woord, 
        coalesce(fa.freq, 0) fqa, 
        coalesce(fb.freq, 0) fqb   
    from (select distinct woord from woord) as aw
    left join (
		select wa.woord as woord, count(wa.woordid) as freq
		from gesprek g
		join reflectie as ra on g.reflectieaid = ra.reflectieid
		join woord as wa on ra.reflectieid = wa.reflectieid
		where g.gesprekid = ?
		group by wa.woord
	) as fa on aw.woord = fa.woord
     left join (
		select wb.woord as woord, count(wb.woordid) as freq
		from gesprek g
		join reflectie as rb on g.reflectiebid = rb.reflectieid
		join woord as wb on rb.reflectieid = wb.reflectieid
		where g.gesprekid = ?
		group by wb.woord
	) as fb on aw.woord = fb.woord
    where fa.woord is not null or fb.woord is not null
    order by coalesce(fa.freq, 0) + coalesce(fb.freq, 0) desc
    limit ?
) as unsorted 
order by woord;
SQL);

$stmt->bind_param("iii", $gesprekselect, $gesprekselect, $resolutie);
$gespreksfocus = explode(",", $_GET["id"]);
$resolutie = $_GET["resolutie"];

foreach ($gespreksfocus as $gesprekselect) {	
	$stmt->execute();
	$result = $stmt->get_result();
	$acountnotsmooth = [];
	$bcountnotsmooth = [];
	while($row = $result->fetch_assoc()) {
		$acountnotsmooth[] = $row["acount"];
		$bcountnotsmooth[] = $row["bcount"];	
	}
	$acountsmooth = [];
	$bcountsmooth = [];
	for($i = 0; $i < count($acountnotsmooth); $i++) {
		$centerpoint = $i * 20 + 20;
		for($j = -20; $j < 20; $j++) {
			$factor = sin(
				(($j / 2.0) / pi()) + 
				(1 / 2 * pi())
			) + 1;
			$acountsmooth[$centerpoint + $j] += $factor * $acountnotsmooth[$i];
			$bcountsmooth[$centerpoint + $j] += $factor * $bcountnotsmooth[$i];
		}
	}

	for($i = 0; $i < count($acountsmooth); $i++) {

		echo <<<HTML
		tmpa.push({$acountsmooth[$i]});
		tmpb.push(-{$bcountsmooth[$i]});
HTML;

	}

?>
	adatas.push(tmpa);
	bdatas.push(tmpb);
	tmpa=[];
	tmpb=[];	
<?php

}

?>

var grafiekbevatter = document.getElementById('grafiekbevatter');

var graph;
var walker = 0;

setInterval(function() {
	walker += 0.01;
	
	var aorig = adatas[Math.floor(walker) % adatas.length];
	var borig = bdatas[Math.floor(walker) % bdatas.length];
	var atarg = adatas[Math.ceil(walker) % adatas.length];
	var btarg = bdatas[Math.ceil(walker) % bdatas.length];

	var orimul = Math.ceil(walker) - walker;
	var tarmul = walker - Math.floor(walker);

	var adata = aorig.map(function(val, ix) {
		return [ix, val * orimul + atarg[ix] * tarmul];
	});

	var bdata = borig.map(function(val, ix) {
		return [ix, val * orimul + btarg[ix] * tarmul];
	})
	
	graph = Flotr.draw(grafiekbevatter, [{
		data: adata,
		lineWidth: 0,
		color: '#ecd9ac',
		lines: {				
			fillColor: '#82a476',
			fill: true
		}
	}, {
		data: bdata,
		lineWidth: 0,
		color: '#ecd9ac',
		lines: {				
			fillColor: '#ec3e2e',
			fill: true
		}
	}], {
		yaxis : {
			max : 25,
			min : -25
		}
	});
}, 25);


</script>

</body>
</html>