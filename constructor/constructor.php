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
	<title></title>
</head>
<body>
	<script type="text/javascript">

		<?php

			echo "var arr = [];" . "\n";


			for ($i=0; $i<sizeof($names); $i++){

				echo "arr.push({name:" . $names[$i] . "});";
				
			}


		?>


	</script>

</body>
</html>
