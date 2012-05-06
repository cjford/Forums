<?php
require_once('/home/cjford/.forum_config.php');

// Creates database connection. Uncomment block below to view available PDO drivers.

/*
foreach(PDO::getAvailableDrivers() as $driver)
    {
    echo $driver.'<br />';
    }
*/

try
{
	$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';' , DB_USERNAME , DB_PASSWORD);
}
catch (PDOException $e)
{
	echo $e -> getMessage();
}

?>
