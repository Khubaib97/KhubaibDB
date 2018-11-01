<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
 
    <div class="container">
  
        <div class="page-header">
            <h1 align="center">Product Update</h1>
        </div>
     
<?php
$code=isset($_GET['code']) ? $_GET['code'] : die('ERROR: Record CODE not found.');

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
    $query = "SELECT * FROM PRODUCT_13102 WHERE CODE='$code'";
    $stmt = $con->prepare($query); 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 

    $name = $row['NAME'];
    $brand = $row['BRAND'];
    $type = $row['TYPE'];
    $shade = $row['SHADE'];
    $size = $row['SIZE'];
    $price = $row['PRICE'];
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php 
if($_POST){
    try{
     
        $query = "UPDATE PRODUCT_13102 SET CODE=:CODE, NAME=:NAME, BRAND=:BRAND, TYPE=:TYPE, SHADE=:SHADE, SIZE=:SIZE, PRICE=:PRICE WHERE CODE='$code'";
 
        $stmt = $con->prepare($query);
 
        $code=htmlspecialchars(strip_tags($_POST['CODE'])); 
        $name=htmlspecialchars(strip_tags($_POST['NAME']));
        $brand=htmlspecialchars(strip_tags($_POST['BRAND']));
        $type=htmlspecialchars(strip_tags($_POST['TYPE']));
	$shade=htmlspecialchars(strip_tags($_POST['SHADE']));
	$size=htmlspecialchars(strip_tags($_POST['SIZE']));
	$price=htmlspecialchars(strip_tags($_POST['PRICE']));
 
	$stmt->bindParam(':CODE', $code);
        $stmt->bindParam(':NAME', $name);
        $stmt->bindParam(':BRAND', $brand);
        $stmt->bindParam(':TYPE', $type);
	$stmt->bindParam(':SHADE', $shade);
	$stmt->bindParam(':SIZE', $size);
	$stmt->bindParam(':PRICE', $price);
         
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
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?code={$code}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Code</td>
            <td><input type='text' name='CODE' value="<?php echo htmlspecialchars($code, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type='text' name='NAME' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Brand</td>
            <td><input type='text' name='BRAND' value="<?php echo htmlspecialchars($brand, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><input type='text' name='TYPE' value="<?php echo htmlspecialchars($type, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Shade</td>
            <td><input type='text' name='SHADE' value="<?php echo htmlspecialchars($shade, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Size</td>
            <td><input type='text' name='SIZE' value="<?php echo htmlspecialchars($size, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='number' name='PRICE' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
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
