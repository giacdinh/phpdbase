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
$i = 0;
foreach ($_GET as $key => $value) {
	if(!empty($value)) {
		${'orig'.$i} = $key;	
		${'ren'.$i} = $value;	
		$i++;
		//echo "$key: $value".'<br>';
	}
}
 
$skip = 0;
for($j=0; $j < $i; $j++) {
    $lkey = ${'orig'.$j};
	$lvalue = ${'ren'.$j};
	if($j > 1) {
		$nextkey = ${'orig'.($j+1)};
		$nextvalue = ${'ren'.($j+1)};
		if(0 == strcmp($nextkey, "value$lkey"))
		{
			$select .= $lkey." as $nextvalue,";
			$j++;
		}
		else if ($j < ($i - 1))
			$select .= $lkey.", ";
		else if ($j == ($i - 1))
			$select .= $lkey;
	//echo "key: $lkey";
	//echo " --  value: $lvalue";
	//echo "<br>";
	}
}
//echo "<br>";
	$i = 1;
	$lvalue = ${'ren'.$i};
$query = "SELECT ".$select." FROM ". $lvalue .";";
//$query = "SELECT id from devices";
echo "$query";

$conn = mysqli_connect("localhost", "ghecu", "giacde", "dlj");
if(!$conn) {
    echo "DBase connect failed";
    die("Connection failed: " . mysqli_connect_error());
    echo "DBase connect failed";
}

$result = mysqli_query($conn, $query);
$all_property = array();  //declare an array for saving property
$rowcnt = mysqli_num_rows($result);
echo "Row count: " .$rowcnt;
//showing property
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
echo '<table class="data-table table table-striped table-bordered">
        <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
   echo '<td><strong>' . strtoupper($property->name) . '</strong></td>';  //get field name for header
   array_push($all_property, $property->name);  //save those to array
}
//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '</td>'; //get items using property value
    }
    echo '</tr>';
}
echo "</table>";
$conn->close();

?>
