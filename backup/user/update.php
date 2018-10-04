<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
 
    <div class="container">
  
        <div class="page-header">
            <h1 align="center">User Update</h1>
        </div>
     
<?php
$username=isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record username not found.');

$host = "localhost";
$db_name = "Khubaib";
$db_username = "root";
$db_password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $db_username, $db_password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
try {
    $query = "SELECT * FROM USER_13102 WHERE USERNAME='$username'";
    $stmt = $con->prepare($query); 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

    $password = $row['PASSWORD'];
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php 
if($_POST){
    try{
     
        $query = "UPDATE USER_13102 SET USERNAME=:USERNAME, PASSWORD=:PASSWORD, SALESPERSON=:SALESPERSON WHERE USERNAME='$username'";
 
        $stmt = $con->prepare($query);
 
        $password=htmlspecialchars(strip_tags($_POST['PASSWORD'])); 
        $username=htmlspecialchars(strip_tags($_POST['USERNAME']));
	$salesperson=htmlspecialchars(strip_tags($_POST['SALESPERSON']));
 
	$stmt->bindParam(':PASSWORD', $password);
        $stmt->bindParam(':USERNAME', $username);
	$stmt->bindParam(':SALESPERSON', $salesperson);
         
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
	    header("refresh:1;url=table.php");
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?username={$row["USERNAME"]}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Username</td>
            <td><input type='text' name='USERNAME' value="<?php echo htmlspecialchars($username, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='text' name='PASSWORD' value="<?php echo htmlspecialchars($password, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
	<td>Salesperson ID</td>
	<td>
	<?php
	$stmt = $con->prepare("select SP_ID from SALESPERSON_13102");
	$stmt->execute();
    	echo "<select name='SALESPERSON' class='form-control'>";
	echo '<option value="">None</option>';
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                  echo '<option value="'.$row["SP_ID"].'">'.$row["SP_ID"].'</option>';                
	}
    	echo "</select>";
	?>
	</td>
	</tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='table.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div>
     
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
