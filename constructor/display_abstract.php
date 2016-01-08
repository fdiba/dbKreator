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
	<title>Abstract Display</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="message">
		<?php


			for ($i=0; $i<sizeof($names); $i++){

				// echo $firstNames[$i] . " " .
				// 	 $names[$i] . " " .
				// 	 // $ctryNames[$i] . "<br />";
				// 	 $ctryNames[$i] . " ";

				echo '<div data-color="' . strlen($firstNames[$i]) . '" class="info">'.$firstNames[$i].'</div>'.
					 '<div data-color="' . strlen($names[$i]) . '" class="info">'.$names[$i].'</div>'.
					 '<div data-color="' . strlen($ctryNames[$i]) . '" class="info">'.$ctryNames[$i].'</div>';
				
			}

		?>
	</div>
	<script src="d3.min.js"></script>
	<script src="js/abstract_script.js"></script>
</body>
</html>
