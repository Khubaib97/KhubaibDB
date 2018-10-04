<html>
<div class="page-header">
	<h1 align="center">Salesperson Table</h1>
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

$conn = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");
//$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM SALESPERSON_13102";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div align="center">';
    echo "<table>
	 <tr>
	 <th>Salesperson ID</th>
	 <th>Name</th>
	 <th>Contact Number</th>
	 <th>IDs of Customers</th>
	 </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["SP_ID"]."</td>
	     <td>".$row["NAME"]."</td>
	     <td>".$row["CONTACT_NO"]."</td>
	     <td>".$row["CUSTOMER_ID"]."</td>";
	     echo "<td>";
	     echo "<a href='update.php?id={$row["SP_ID"]}&cid={$row["CUSTOMER_ID"]}' class='btn btn-primary m-r-1em'>Edit</a>";
	     echo " ";
             echo "<a href='#' onclick='delete_user({$row["SP_ID"]},{$row["CUSTOMER_ID"]});'  class='btn btn-danger'>Delete</a>";	
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
function delete_user(spid,cid){
    var answer = confirm('Are you sure?');
    if (answer){
        window.location = 'delete.php?spid='+spid+'&cid='+cid;
    } 
}
</script>
</head>
</html>
