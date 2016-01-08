<?php require("access/connexion.php"); ?>
<?php

	$firstNames = array();
	$names = array();
	$ctryNames = array();

	// $sth = $dbh->query('SELECT name from country');

	$sth = $dbh->query('SELECT artist.firstName, artist.name, country.c_name
						FROM artist
						INNER JOIN country
						ON artist.id_country = country.id
						');

	$sth->setFetchMode(PDO::FETCH_ASSOC);

	while($row = $sth->fetch()) {
		array_push($firstNames, $row['firstName']);
		array_push($names, $row['name']);
		array_push($ctryNames, $row['c_name']);
	}

	$dbh=null;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<div id="message">
		<?php


			for ($i=0; $i<sizeof($names); $i++){

				echo $firstNames[$i] . " " .
					 $names[$i] . " " .
					 // $ctryNames[$i] . "<br />";
					 $ctryNames[$i] . " ";
				
			}

		?>
	</div>
</body>
</html>
