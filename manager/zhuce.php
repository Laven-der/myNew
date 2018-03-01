<?php
     $username = $_POST["username"];
    $password = $_POST["password"];
    $sex = $_POST["sex"];
    $qq = $_POST["qq"];
    // 连接数据库 参数  ： 地址 、 用户名 、 密码
    mysql_connect("localhost","root",123456);
    // 选择哪个数据库
    mysql_select_db("edu");
    // 识别中文字符
    mysql_query("SET NAMES UTF8");
    // 写执行的sql语句
    // 快捷键  ctrl+k+u 变大写
    $sql = "INSERT INTO user (username,password,sex,qq) VALUE ('{$username}','{$password}','{$sex}','{$qq}')";
    // 执行sql
    $result = mysql_query($sql);
   if( $result == 1){
        echo "success";
    }else{
        echo "fail";
    }
?>