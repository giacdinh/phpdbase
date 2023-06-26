<html>
   <head>
    </head>
    <body>
    </body>
</html>
<?php
// Database configuration
$hostname = 'localhost';
$username = 'ghecu';
$password = 'giacde';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$hostname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to retrieve the database names
    $query = "SHOW DATABASES";
    $statement = $pdo->query($query);
    
    // Fetch the database names
    $databases = $statement->fetchAll(PDO::FETCH_COLUMN);
    
//echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
//echo '<table class="data-table table table-striped table-bordered">
//		<tr class="data-heading">';

echo 'Select <br>';
//echo '</tr>';

    // Display the database names
    foreach ($databases as $database) {
		echo '<form action="/show_table.php"><input type="checkbox" name="dbase" value="'.$database.'"><input type="submit" value="Dbase"> '.$database.'</form> ';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
