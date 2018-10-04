<?php
 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Asna";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM CUSTOMER_13009";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
	 <tr>
	 <th>ShopID</th>
	 <th>ShopName</th>
	 <th>ContactPerson</th>
	 <th>ContactNo</th>
	 <th>Area</th>
	 <th>Address</th>
	 <th>Coordinates</th>
	 </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["ShopID"]."</td>
	     <td>".$row["ShopName"]."</td>
	     <td>".$row["ContactPerson"]."</td>
	     <td>".$row["ContactNo"]."</td>
	     <td>".$row["Address"]."</td>
	     <td>".$row["Area"]."</td>
	     <td>".$row["Coordinates"]."</td>";
	     echo "<td>";
	     echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 20px;
}
td{
    background-color: 	#90EE90;
}
th{
    background-color: 	#008000;
}
</style>

</head>
</html>
