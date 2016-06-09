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

			for ($i=0; $i<sizeof($objects); $i++){

				$str = $objects[$i][0] . ' ' . $objects[$i][1];

				echo "<div>" . $str . "</div>";
				
			}

		?>
	</div>
</body>
</html>