<?php
$host = "localhost";
$db_name = "Khubaib";
$db_username = "khubaib";
$db_password = "13102";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $db_username, $db_password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

try {
    $username=isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record username not found.');

    $query = "DELETE FROM USER_13102 WHERE USERNAME='$username'";
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
