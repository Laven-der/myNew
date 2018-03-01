<?php
    // 获取post的数据
    $id = $_POST["id"];
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
    $sql = "UPDATE teacher SET num='{$num}',name='{$name}',age='{$age}',sex='{$sex}',work='{$work}',email='{$email}',year='{$year}' WHERE id = {$id}";

    $result = mysql_query($sql);

    // 变成数组
    // 验证
    if( $result == "1"){

       echo "success";

    }else{

     echo "fail";
    }
?>