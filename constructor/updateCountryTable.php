<?php require("access/connexion.php"); ?>
<?php

$name = $_POST['name'];

$dbh->exec("INSERT INTO country (c_name)
			SELECT * FROM (SELECT '" . $name ."')
			AS tmp
			WHERE NOT EXISTS (
				SELECT c_name
				FROM country
				WHERE c_name ='" . $name ."' 
			) LIMIT 1;")
			or die(print_r($dbh->errorInfo()[2] . "\n" .
				"already in =====> " . $name, true));

echo $name;

$dbh=null;

?>