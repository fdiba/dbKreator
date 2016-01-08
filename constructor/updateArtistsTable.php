<?php require("access/connexion.php"); ?>
<?php

$firstName = $_POST['firstName'];
$name = $_POST['name'];
$country = $_POST['country'];


//--- search id country ---//


$arr = array();

$sth = $dbh->query("SELECT * from country
					WHERE name ='" . $country . "' LIMIT 1");

$sth->setFetchMode(PDO::FETCH_ASSOC);

while($row = $sth->fetch()) {
	array_push($arr, $row['id']);
}

$id_country = $arr[0];

//--- add new row ---//

$dbh->exec("INSERT INTO artist (firstName, name, id_country)
			SELECT * FROM (SELECT '" . $firstName . "',
								  '" . $name . "',
								  '" . $id_country . "')AS tmp
			WHERE NOT EXISTS (
				SELECT name FROM artist WHERE firstName ='" . $firstName ."'
				AND name = '" . $name . "') LIMIT 1;")
			// or die(print_r($dbh->errorInfo(), true));
			or die(print_r($dbh->errorInfo() . "\n" .
				$firstName . " " . $name . ' ---------------', true));

/*INSERT INTO table_listnames (name, address, tele)
SELECT * FROM (SELECT 'Rupert', 'Somewhere', '022') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM table_listnames WHERE name = 'Rupert'
) LIMIT 1;*/

//$dbh->exec("DELETE FROM country WHERE name = 'rouge'")

echo $name;

$dbh=null;



// echo $arr[0] . " " . $name;

?>