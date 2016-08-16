<?php require("access/connexion.php"); ?>
<?php require("functions.php"); ?>
<?php

	$objects = array();

	$sth = $dbh->query('SELECT id, c_name FROM country');

	$sth->setFetchMode(PDO::FETCH_ASSOC);

	while($row = $sth->fetch()) {
		array_push($objects, array($row['id'], $row['c_name']));
	}

	$dbh=null;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Display Countries Line By Line</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="message">
		<?php

			$count=0;

			for ($i=0; $i<sizeof($objects); $i++){

				$str = $objects[$i][1] . ' ' . $objects[$i][0];

				echo "<div>" . $count . ' ' . $str . "</div>";
				
				$count++;
			}

		?>
	</div>
</body>
</html>