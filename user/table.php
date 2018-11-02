<html>
<div class="page-header">
	<h1 align="center">User Table</h1>
</div>
</html>
<?php
include('../main/session.php');
if($login_session!=='admin'){
    header('Location: ../main/welcome.php?action=rejected');
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
$servername = "localhost";
$db_username = "khubaib";
$db_password = "13102";
$dbname = "Khubaib";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM USER_13102";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div align="center">';
    echo "<table>
	 <tr>
	 <th>Username</th>
	 <th>Password</th>
	 <th>Active</th>
	 <th>Salesperson</th>
	 </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["USERNAME"]."</td>
	     <td>".$row["PASSWORD"]."</td>
	     <td>".$row["ACTIVE"]."</td>
	     <td>".$row["SALESPERSON"]."</td>";
	     echo "<td>";
	     echo "<a href='update.php?username={$row["USERNAME"]}' class='btn btn-primary m-r-1em'>Edit</a>";
	     echo " ";
             echo "<a href='delete.php?username={$row["USERNAME"]}' class='btn btn-danger'>Delete</a>";	
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
echo "<a href='../main/welcome.php' class='btn btn-primary m-r-1em'>Home</a>";
echo "<a href = '../main/logout.php' class='btn btn-danger'>Sign Out</a>";
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
</head>
</html>
