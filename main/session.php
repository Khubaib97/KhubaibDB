<?php
   $servername = "localhost";
   $username = "khubaib";
   $password = "13102";
   $dbname = "Khubaib";

   $db = new mysqli($servername, $username, $password, $dbname);
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select USERNAME from USER_13102 where USERNAME='$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['USERNAME'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:../main/login.php");
   }
?>
