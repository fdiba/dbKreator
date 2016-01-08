<?php require("access/connexion.php"); ?>
<?php

$firstName = $_POST['firstName'];
$name = $_POST['name'];


//--- search artist id ---//


$arr = array();

$sth = $dbh->query("SELECT * from artist
					WHERE firstName ='" . $firstName . "'
					AND name = '" . $name . "'
					LIMIT 1");


$sth->setFetchMode(PDO::FETCH_ASSOC);

while($row = $sth->fetch()) {
	array_push($arr, $row['id']);
}

$id_artist = $arr[0];

//--- add new row ---//

$dbh->exec("INSERT INTO edition (artist_id, ed_1973)
			VALUES('" . $id_artist . "', 1)
			ON DUPLICATE KEY UPDATE
			artist_id= '" . $id_artist . "', ed_1973=1")

	or die(print_r($dbh->errorInfo() . "\n" .
		$id_artist . " ".
		$firstName . " " .
		$name . ' <--------------- check it', true));

/*INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE    
name="A", age=19*/

/*$dbh->exec("INSERT INTO edition (artist_id, ed_1973)
			SELECT * FROM (SELECT '" . $id_artist . "',
								  '1') AS tmp
			WHERE NOT EXISTS (
			    SELECT artist_id FROM edition WHERE artist_id = '" . $id_artist . "'
			) LIMIT 1;")
			or die(print_r($dbh->errorInfo() . "\n" .
				$id_artist . " ".
				$firstName . " " .
				$name . ' <--------------- check it', true));*/


/*INSERT INTO table_listnames (name, address, tele)
SELECT * FROM (SELECT 'Rupert', 'Somewhere', '022') AS tmp
WHERE NOT EXISTS (
    SELECT name FROM table_listnames WHERE name = 'Rupert'
) LIMIT 1;*/

echo $id_artist;

$dbh=null;

?>