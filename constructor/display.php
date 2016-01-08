<?php require("access/connexion.php"); ?>
<?php

	$names = array();

	$sth = $dbh->query('SELECT name from country');

	$sth->setFetchMode(PDO::FETCH_ASSOC);

	while($row = $sth->fetch()) {
		array_push($names, $row['name']);
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

				echo $names[$i] . '<br />' . "\n";
				
			}

		?>
	</div>
</body>
</html>
