<html>
<div class="page-header">
	<h1 align="center">Product Table</h1>
</div>
</html>
<?php
include('../main/session.php');
$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Khubaib";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM PRODUCT_13102";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div align="center">';
    echo "<table>
	 <tr>
	 <th>Code</th>
	 <th>Name</th>
	 <th>Brand</th>
	 <th>Type</th>
	 <th>Shade</th>
	 <th>Size</th>
	 <th>Price</th>
	 </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["CODE"]."</td>
	     <td>".$row["NAME"]."</td>
	     <td>".$row["BRAND"]."</td>
	     <td>".$row["TYPE"]."</td>
	     <td>".$row["SHADE"]."</td>
	     <td>".$row["SIZE"]."</td>
	     <td>".$row["PRICE"]."</td>";
	     echo "<td>";
	     echo "<a href='update.php?code={$row["CODE"]}' class='btn btn-primary m-r-1em'>Edit</a>";
	     echo " ";
             echo "<a href='#' onclick='delete_user({$row["CODE"]});'  class='btn btn-danger'>Delete</a>";	
	     echo "</td>";
	     echo "</tr>";
    }
    echo "</table>";
    echo '</div>';
} else {
    echo "0 results";
}
echo '<div align="center" style="margin: 20px">';
echo "<a href='create.php' class='btn btn-primary m-r-1em'>Create New Record</a>";
echo '</div>';
echo '<div align="center" style="margin: 20px">';
echo "<a href='/main/welcome.php' class='btn btn-primary m-r-1em'>Home</a>";
echo "<a href = '/main/logout.php' class='btn btn-danger'>Sign Out</a>";
echo '</div>';
$conn->close();
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
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
table{
    margin: 10px;
}
</style>
<script type='text/javascript'>
function delete_user(code){
    var answer = confirm('Are you sure?');
    if (answer){
        window.location = 'delete.php?code='+code;
    } 
}
</script>
</head>
</html>
