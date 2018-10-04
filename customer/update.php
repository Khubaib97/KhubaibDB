<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
 
    <div class="container">
  
        <div class="page-header">
            <h1 align="center">Customer Update</h1>
        </div>
     
<?php
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

$host = "localhost";
$db_name = "Khubaib";
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
try {
    $query = "SELECT * FROM CUSTOMER_13102 WHERE Shop_ID='$id'";
    $stmt = $con->prepare($query); 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
	
    $shopname = $row['Shop_Name'];
    $contactperson = $row['Contact_Person'];
    $contactno = $row['Contact_No'];
    $address = $row['Address'];
    $area = $row['Area'];
    $coordinates = $row['Coordinates'];
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php 
if($_POST){
    try{
     
        $query = "UPDATE CUSTOMER_13102 SET Shop_ID=:Shop_ID, Shop_Name=:Shop_Name, Contact_Person=:Contact_Person, Contact_No=:Contact_No, Address=:Address, Area=:Area, Coordinates=:Coordinates 
                    WHERE Shop_ID='$id'";
 
        $stmt = $con->prepare($query);
 	
	$id=htmlspecialchars(strip_tags($_POST['Shop_ID']));
        $shopname=htmlspecialchars(strip_tags($_POST['Shop_Name']));
        $contactperson=htmlspecialchars(strip_tags($_POST['Contact_Person']));
        $contactno=htmlspecialchars(strip_tags($_POST['Contact_No']));
	$address=htmlspecialchars(strip_tags($_POST['Address']));
	$area=htmlspecialchars(strip_tags($_POST['Area']));
	$coordinates=htmlspecialchars(strip_tags($_POST['Coordinates']));
 
	$stmt->bindParam(':Shop_ID', $id);
        $stmt->bindParam(':Shop_Name', $shopname);
        $stmt->bindParam(':Contact_Person', $contactperson);
        $stmt->bindParam(':Contact_No', $contactno);
	$stmt->bindParam(':Address', $address);
	$stmt->bindParam(':Area', $area);
	$stmt->bindParam(':Coordinates', $coordinates);
         
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
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Shop ID</td>
            <td><input type='text' name='Shop_ID' value="<?php echo htmlspecialchars($id, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Shop name</td>
            <td><input type='text' name='Shop_Name' value="<?php echo htmlspecialchars($shopname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td><input type='text' name='Contact_Person' value="<?php echo htmlspecialchars($contactperson, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact No</td>
            <td><input type='text' name='Contact_No' value="<?php echo htmlspecialchars($contactno, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type='text' name='Address' value="<?php echo htmlspecialchars($address, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Area</td>
            <td><input type='text' name='Area' value="<?php echo htmlspecialchars($area, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Coordinates</td>
            <td><input type='text' name='Coordinates' value="<?php echo htmlspecialchars($coordinates, ENT_QUOTES);  ?>" class='form-control' /></td>
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
