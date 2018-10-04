<?php
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
    $spid=isset($_GET['spid']) ? $_GET['spid'] : die('ERROR: Record ID not found.');
    $cid=isset($_GET['cid']) ? $_GET['cid'] : die('ERROR: Record CID not found.');

    $query = "DELETE FROM SALESPERSON_13102 WHERE SP_ID='$spid' AND CUSTOMER_ID='$cid'";
    $stmt = $con->prepare($query);
     
    if($stmt->execute()){
        header('Location: table.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
