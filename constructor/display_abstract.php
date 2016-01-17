<?php require("access/connexion.php"); ?>
<?php

	$objects = array();


	$sth = $dbh->query('SELECT artist.firstName, artist.name,
							   country.c_name,
							   edition.ed_1973, edition.ed_1974,
							   edition.ed_1975, edition.ed_1976,
							   edition.ed_1977, edition.ed_1978,
							   edition.ed_1979, edition.ed_1980

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
		if ($row['ed_1978']) array_push($objects[sizeof($objects)-1][3], '1978');
		if ($row['ed_1979']) array_push($objects[sizeof($objects)-1][3], '1979');
		if ($row['ed_1980']) array_push($objects[sizeof($objects)-1][3], '1980');


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

			for ($i=0; $i<sizeof($objects); $i++){

				$firstName = $objects[$i][0];
				$name = $objects[$i][1];
				$country = $objects[$i][2];

				$color1 = getColor($firstName);
				$color2 = getColor($name);
				$color3 = getColor($country);

				$hexColor = RGBToHex($color1, $color2, $color3);
				// $ctryColor = RGBToHex($color3, $color3, $color3);

				echo '<div data-color="' . $hexColor .
						'" data-str="' . $firstName .
						'" data-width="' . strlen($firstName) .
						'" class="info">'.$firstName.'</div>'.

					 '<div data-color="' . $hexColor .
					 	'" data-str="' . $name .
					 	'" data-width="' . strlen($name) . 
					 	'" class="info">'.$name.'</div>'.

					 '<div data-color="' . $hexColor .
					 	'" data-str="' . $country .
					 	'" data-width="' . strlen($country) . 
					 	'" class="info">'.$country.'</div>';

				//-------- years ---------//
				$years = $objects[$i][3];

				for ($j=0; $j<sizeof($years); $j++){

					$year = $years[$j];
					$rgbValue = getColor($year);
					$color = RGBToHex($rgbValue, $rgbValue, $rgbValue);


					echo '<div data-color="' . $color .
						'" data-str="' . $year .
						'" data-width="' . strlen($year) .
						'" class="info">'.$year.'</div>';

				}				
			}
		?>
	</div>
	<script src="jquery-1.11.3.min.js"></script>
	<script src="d3.min.js"></script>
	<script src="js/abstract_script.js"></script>
</body>
</html>
