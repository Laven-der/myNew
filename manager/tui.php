<?php
     session_start(); //开启session
        $_SESSION['islogin'] = false;
        header("Location:index.html");exit;
?>