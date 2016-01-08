<?php require("access/connexion.php"); ?>
<?php

$name = $_POST['name'];

$dbh->exec("

INSERT INTO country (name)
SELECT * FROM (SELECT '" . $name ."') AS tmp
WHERE NOT EXISTS (
	SELECT name FROM country WHERE name ='" . $name ."' 
) LIMIT 1;")

or die(print_r($dbh->errorInfo(), true));

?>