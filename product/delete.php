<?php
$host = "localhost";
$db_name = "Khubaib";
$username = "root";
$password = "";
  
try {
    $dsn = getenv('MYSQL_DSN');
    $user = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');
    $con = new PDO($dsn, $user, $password);
    //$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
 
try {
    $code=isset($_GET['code']) ? $_GET['code'] : die('ERROR: Record code not found.');
 
    $query = "DELETE FROM PRODUCT_13102 WHERE CODE={$code}";
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
