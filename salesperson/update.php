<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
 
    <div class="container">
  
        <div class="page-header">
            <h1 align="center">Salesperson Update</h1>
        </div>
     
<?php
$spid=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
$cid=isset($_GET['cid']) ? $_GET['cid'] : die('ERROR: Record CID not found.');

$host = "localhost";
$db_name = "Khubaib";
$username = "khubaib";
$password = "13102";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
try {
    $query = "SELECT * FROM SALESPERSON_13102 WHERE SP_ID='$spid' AND CUSTOMER_ID='$cid'";
    $stmt = $con->prepare($query); 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

    $name = $row['NAME'];
    $contact = $row['CONTACT_NO'];
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php 
if($_POST){
    try{
     
        $query = "UPDATE SALESPERSON_13102 SET SP_ID=:SP_ID, NAME=:NAME, CONTACT_NO=:CONTACT_NO, CUSTOMER_ID=:CUSTOMER_ID WHERE SP_ID='$spid' AND CUSTOMER_ID='$cid'";
 
        $stmt = $con->prepare($query);
 
        $spid=htmlspecialchars(strip_tags($_POST['SP_ID'])); 
        $name=htmlspecialchars(strip_tags($_POST['NAME']));
        $contact=htmlspecialchars(strip_tags($_POST['CONTACT_NO']));
        $cid=htmlspecialchars(strip_tags($_POST['CUSTOMER_ID']));
 
	$stmt->bindParam(':SP_ID', $spid);
        $stmt->bindParam(':NAME', $name);
        $stmt->bindParam(':CONTACT_NO', $contact);
        $stmt->bindParam(':CUSTOMER_ID', $cid);
         
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
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$row["SP_ID"]}&cid={$row["CUSTOMER_ID"]}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Salesperson ID</td>
            <td><input type='text' name='SP_ID' value="<?php echo htmlspecialchars($spid, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type='text' name='NAME' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td><input type='text' name='CONTACT_NO' value="<?php echo htmlspecialchars($contact, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
	<td>Customer ID</td>
	<td>
	<?php
	$stmt = $con->prepare("select Shop_ID from CUSTOMER_13102");
	$stmt->execute();
    	echo "<select name='CUSTOMER_ID' class='form-control'>";
	echo '<option value="">None</option>';
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo '<option value="'.$row["Shop_ID"].'">'.$row["Shop_ID"].'</option>';               
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
