<html>
<div class="page-header">
	<h1 align="center">Customer Table</h1>
</div>
</html>
<?php
   $db = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select USERNAME from USER_13102 where USERNAME='$user_check'");
   
   $row1 = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row1['USERNAME'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:/main/login.php");
   }
$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Khubaib";

// Create connection
$conn = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM CUSTOMER_13102";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div align="center">';
    echo "<table>
	 <tr>
	 <th>Shop ID</th>
	 <th>Shop_Name</th>
	 <th>Contact_Person</th>
	 <th>Contact_No</th>
	 <th>Address</th>
	 <th>Area</th>
	 <th>Coordinates</th>
	 </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["Shop_ID"]."</td>
	     <td>".$row["Shop_Name"]."</td>
	     <td>".$row["Contact_Person"]."</td>
	     <td>".$row["Contact_No"]."</td>
	     <td>".$row["Address"]."</td>
	     <td>".$row["Area"]."</td>
	     <td>".$row["Coordinates"]."</td>";
	     echo "<td>";
	     echo "<a href='update.php?id={$row["Shop_ID"]}' class='btn btn-primary m-r-1em'>Edit</a>";
	     echo " ";
             echo "<a href='#' onclick='delete_user({$row["Shop_ID"]});'  class='btn btn-danger'>Delete</a>";	
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
function delete_user( id ){
    var answer = confirm('Are you sure?');
    if (answer){
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
</head>
</html>
