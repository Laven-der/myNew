<?php
    // 获取post的数据
    $num = $_POST["num"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $sex = $_POST["sex"];
    $work = $_POST["work"];
    $email = $_POST["email"];
    $year = $_POST["year"];
    // 连接数据库 参数  ： 地址 、 用户名 、 密码
   mysql_connect("localhost","root",123456);
   // 选择哪个数据库
   mysql_select_db("edu");
   // 识别中文字符
   mysql_query("SET NAMES UTF8");
   // 写执行的sql语句
   // 快捷键  ctrl+k+u
   $sql = "INSERT INTO teacher (num,name,age,sex,work,email,year) VALUE ('{$num}','{$name}','{$age}','{$sex}','{$work}','{$email}','{$year}')";
   // 执行sql ,插入数据成功，返回的值是1
   $result = mysql_query($sql);

   if( $result == "1"){

      echo "success";

   }else{

    echo "fail";
   }
?>
