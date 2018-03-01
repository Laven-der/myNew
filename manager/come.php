<?php
     session_start(); //开启session
        $_SESSION['islogin'] = true;
        header("Location: teacher.php");exit;
?>