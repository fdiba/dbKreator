<?php require("access/connexion.php"); ?>
<?php

$name = $_POST['name'];



/*INSERT INTO table_listnames (name, address, tele)
SELECT * FROM (SELECT 'Rupert', 'Somewhere', '022') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM table_listnames WHERE name = 'Rupert'
) LIMIT 1;*/

$dbh->exec("

INSERT INTO country (name)
SELECT * FROM (SELECT '" . $name ."') AS tmp
WHERE NOT EXISTS (
	SELECT name FROM country WHERE name ='" . $name ."' 
) LIMIT 1;")

//$dbh->exec("DELETE FROM country WHERE name = 'rouge'")

or die(print_r($dbh->errorInfo(), true));

?>