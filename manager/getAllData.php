 <?php
    // 连接数据库 参数  ： 地址 、 用户名 、 密码
    mysql_connect("localhost","root",123456);
    // 选择哪个数据库
    mysql_select_db("edu");
    // 识别中文字符
    mysql_query("SET NAMES UTF8");
    // 写执行的sql语句
    // 快捷键  ctrl+k+u 变大写
    $sql = "SELECT * FROM teacher ORDER BY id ASC";
    // 执行sql
    $result = mysql_query($sql);
    // 把$result类数组对象变成数组
    $arr = array();
    // 循环
    while( $row = mysql_fetch_array($result) ){
        array_push($arr,$row);
    }
    $allData = array("result"=>$arr);
    echo json_encode($allData)
?>