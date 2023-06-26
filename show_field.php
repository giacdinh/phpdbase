<html>
	<head>
	<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th {
  background-color: #4CAF50;
}
.tab1 {
	tab-size: 8;
}
	</style>
	</head>
</html>
<?php
$table = $_GET['table'];
$database = $_GET['dbase'];
// Database configuration
$hostname = 'localhost';
$username = 'ghecu';
$password = 'giacde';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// Execute the query to fetch the name column from the table

	$query = "SELECT * FROM $table";
	$stmt = $pdo->query($query);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo 'Field name display for table: '.$table.' in database: '.$database.'';
	if ($result) {
		$fieldNames = array_keys($result[0]);
	    echo '<form action="/search_field.php">';
        echo '<input type="hidden" name="dbase" value="'.$database.'">';
        echo '<input type="hidden" name="table" value="'.$table.'">';
		foreach ($fieldNames as $fieldName) {
			echo '<input type="checkbox" name="'.$fieldName.'" />';
            echo 'FIELD:"'.$fieldName.'" display as <input type="text" name="value'.$fieldName.'" /><br>';
		}
		echo '<input type="submit" value="Submit"> </form>';
	}

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
