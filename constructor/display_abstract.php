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
							   edition.ed_1989, edition.ed_1990,
							   edition.ed_1991, edition.ed_1992,
							   edition.ed_1993, edition.ed_1994,
							   edition.ed_1995, edition.ed_1996,
							   edition.ed_1997, edition.ed_1998,
							   edition.ed_1999, edition.ed_2000,
							   edition.ed_2001, edition.ed_2002,
							   edition.ed_2003, edition.ed_2004,
							   edition.ed_2005, edition.ed_2006,
							   edition.ed_2007, edition.ed_2008,
							   edition.ed_2009
							
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
	<title>Abstract Display</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/abstract_display.css">
</head>
<body>
	<div id="info_bar"><p>Index</p></div>
	<div id="message">
		<?php

			//for ($i=0; $i<200; $i++){
			for ($i=0; $i<sizeof($objects); $i++){

				$firstName = $objects[$i][0];
				$name = $objects[$i][1];
				$country = $objects[$i][2];

				//$color1 = getColor($firstName);
				//$color2 = getColor($name);
				//$color3 = getColor($country);

				//$hexColor = RGBToHex($color1, $color2, $color3);
				$hexColor = RGBToHex(225, 225, 225); //grey
				// $ctryColor = RGBToHex($color3, $color3, $color3);

				$length = strlen($firstName)  + strlen($name); 
				$str = $firstName . ' ' .
					   $name . ' ' . 
					   $country . ' ' . implode("\n", $objects[$i][3]);;

				echo '<div data-color="' . $hexColor .
						'" data-str="' . $str .
						'" data-width="' . $length .
						'" class="info">' . $str .'</div>';

				//-------- years ---------//
				$years = $objects[$i][3];

				for ($j=0; $j<sizeof($years); $j++){

					$year = $years[$j];
					$rgbValue = getColor($year);
					$color = RGBToHex($rgbValue, $rgbValue, $rgbValue);


					echo '<div data-color="' . $color .
						'" data-str="' . $year .
						'" data-width="' . strlen($year) .
						'" class="edition">'.$year.'</div>';

				}				
			}
		?>
	</div>
	<script src="jquery-1.11.3.min.js"></script>
	<script src="d3.min.js"></script>
	<script src="js/abstract_script.js"></script>
</body>
</html>
