<?php
    $id = $_GET["id"];
    // 连接数据库 参数  ： 地址 、 用户名 、 密码
    mysql_connect("localhost","root",123456);
    // 选择哪个数据库
    mysql_select_db("edu");
    // 识别中文字符
    mysql_query("SET NAMES UTF8");
    // 写执行的sql语句
    // 快捷键  ctrl+k+u
    $sql = "DELETE FROM teacher WHERE id = {$id}";
    // 执行
    // 删除成功返回1
    $result = mysql_query($sql);
    // 验证
    if( $result == "1"){

       echo "success";

    }else{

     echo "fail";
    }
?>