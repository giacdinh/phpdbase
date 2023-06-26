<?php
$database = $_GET['dbase'];
// Database configuration
$hostname = 'localhost';
$username = 'ghecu';
$password = 'giacde';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to retrieve the table names
    $query = "SHOW TABLES";
    $statement = $pdo->query($query);
    
    // Fetch the table names
    $tables = $statement->fetchAll(PDO::FETCH_COLUMN);
    
    // Display the table names
    echo "Tables in the database: ".$database."<br>";
    foreach ($tables as $table) {
		echo '<form action="/show_field.php">
				<input type="checkbox" name="table" value="'.$table.'">
				<input type="submit" value="Table"> '.$table.'
				<input type="hidden" name="dbase" value="'.$database.'">
			 </form>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
