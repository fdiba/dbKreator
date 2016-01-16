<?php require("access/connexion.php"); ?>
<?php

	$objects = array();

	$sth = $dbh->query('SELECT artist.firstName, artist.name,
							   country.c_name,
							   edition.ed_1973, edition.ed_1974
						FROM artist
						INNER JOIN country
						ON artist.id_country = country.id
						INNER JOIN edition
						ON artist.id = edition.artist_id
						');

	$sth->setFetchMode(PDO::FETCH_ASSOC);

	while($row = $sth->fetch()) {

		array_push($objects, array($row['firstName'], $row['name'],
								   $row['c_name'], ''));

		//set up years
		if ($row['ed_1973']) $objects[sizeof($objects)-1][3] = '1973';
		if ($row['ed_1974']) {
			if($objects[sizeof($objects)-1][3]) $objects[sizeof($objects)-1][3] .= ', 1974';
			else $objects[sizeof($objects)-1][3] .= '1974';	
		}

	}

	$dbh=null;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
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

				$str = $str . $objects[$i][3] . ' '; //years
				echo $str;
				
			}

		?>
	</div>
</body>
</html>
