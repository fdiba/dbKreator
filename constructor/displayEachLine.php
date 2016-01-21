<?php require("access/connexion.php"); ?>
<?php require("functions.php"); ?>
<?php

	$objects = array();
	$years = getYears();

	$sth = $dbh->query('SELECT artist.firstName, artist.name,
							   country.c_name,
							   edition.ed_1973, edition.ed_1974,
							   edition.ed_1975, edition.ed_1976,
							   edition.ed_1977, edition.ed_1978,
							   edition.ed_1979, edition.ed_1980,
							   edition.ed_1981, edition.ed_1982,
							   edition.ed_1983, edition.ed_1984,
							   edition.ed_1985, edition.ed_1986,
							   edition.ed_1987, edition.ed_1988,
							   edition.ed_1989, edition.ed_1990

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

		for($i = 0; $i <sizeof($years); $i++){
			$column_name = 'ed_' . $years[$i];
			if ($row[$column_name]) array_push($objects[sizeof($objects)-1][3], $years[$i]);
		}
		
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
