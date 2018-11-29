<?php
   session_start();
   $servername = "localhost";
   $username = "khubaib";
   $password = "13102";
   $dbname = "Khubaib";

   $db = new mysqli($servername, $username, $password, $dbname);
   $user_check = $_SESSION['login_user'];
   
   mysqli_query($db, "UPDATE USER_13102 SET ACTIVE='N' WHERE USERNAME='$user_check'");
   
   if(session_destroy()) {
      header("Location: ../main/login.php");
   }
?>
