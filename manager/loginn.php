<?php
     $username = $_POST["username"];
    $password = $_POST["password"];
    // 连接数据库 参数  ： 地址 、 用户名 、 密码
    mysql_connect("localhost","root",123456);
    // 选择哪个数据库
    mysql_select_db("edu");
    // 识别中文字符
    mysql_query("SET NAMES UTF8");
    // 写执行的sql语句
    // 快捷键  ctrl+k+u 变大写
   $sql ="SELECT * FROM user WHERE username='$username' and password='$password'";
    // 执行sql
    $result = mysql_query($sql);
    $tiaomu = mysql_num_rows($result);
    if( $tiaomu>0){
        echo "success";
    }else{
     echo "fail";
    }
?>