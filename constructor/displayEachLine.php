<?php require("access/connexion.php"); ?>
<?php

	$objects = array();

	$sth = $dbh->query('SELECT artist.firstName, artist.name,
							   country.c_name,
							   edition.ed_1973, edition.ed_1974,
							   edition.ed_1975, edition.ed_1976,
							   edition.ed_1977, edition.ed_1978

						FROM artist
						INNER JOIN country
						ON artist.id_country = country.id
						INNER JOIN edition
						ON artist.id = edition.artist_id
						');

	$sth->setFetchMode(PDO::FETCH_ASSOC);

	while($row = $sth->fetch()) {

		array_push($objects, array($row['firstName'], $row['name'],
								   $row['c_name'], array()));

		//set up years
		if ($row['ed_1973']) array_push($objects[sizeof($objects)-1][3], '1973');
		if ($row['ed_1974']) array_push($objects[sizeof($objects)-1][3], '1974');
		if ($row['ed_1975']) array_push($objects[sizeof($objects)-1][3], '1975');
		if ($row['ed_1976']) array_push($objects[sizeof($objects)-1][3], '1976');
		if ($row['ed_1977']) array_push($objects[sizeof($objects)-1][3], '1977');

	}

	$dbh=null;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Line By Line Display</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="message">
		<?php

			for ($i=0; $i<sizeof($objects); $i++){

				$str = '';

				if($objects[$i][0]) $str = $objects[$i][0] . ' '; //firstName
				if($objects[$i][1]) $str = $str . $objects[$i][1] . ' '; //name
				if($objects[$i][2]) $str = $str . $objects[$i][2] . ' '; //country


				//-------- years ---------//
				$years = $objects[$i][3];

				for ($j=0; $j<sizeof($years); $j++){
					$str = $str . $years[$j];

					if($j<sizeof($years)-1) $str = $str . ' '; //', '
					else $str = $str . ' ';
				}

				echo "<div>" . $str . "</div>";
				
			}

		?>
	</div>
</body>
</html>
