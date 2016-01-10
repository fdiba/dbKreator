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

			function getColor($str){

				$value = 0;

				$arr1 = str_split($str);
				
				for ($i=0; $i<sizeof($arr1); $i++){
					$value += ord($arr1[$i]);
				}
				
				return $value%255;
			}

			function RGBToHex($r, $g, $b) {

				$hex = "#";
				$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
				$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
				$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
		 
				return $hex;
			}

			for ($i=0; $i<sizeof($names); $i++){

				$color1 = getColor($firstNames[$i]);
				$color2 = getColor($names[$i]);
				$color3 = getColor($ctryNames[$i]);

				$hexColor = RGBToHex($color1, $color2, $color3);

				echo '<div data-color="' . $hexColor .
						'" data-str="' . $firstNames[$i] .
						'" data-width="' . strlen($firstNames[$i]) .
						'" class="info">'.$firstNames[$i].'</div>'.

					 '<div data-color="' . $hexColor .
					 	'" data-str="' . $names[$i] .
					 	'" data-width="' . strlen($names[$i]) . 
					 	'" class="info">'.$names[$i].'</div>'.

					 '<div data-color="' . $hexColor .
					 	'" data-str="' . $ctryNames[$i] .
					 	'" data-width="' . strlen($ctryNames[$i]) . 
					 	'" class="info">'.$ctryNames[$i].'</div>';
				
			}

		?>
	</div>
	<script src="jquery-1.11.3.min.js"></script>
	<script src="d3.min.js"></script>
	<script src="js/abstract_script.js"></script>
</body>
</html>
