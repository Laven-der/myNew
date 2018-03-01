<?php 
     $num = $_POST["num"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $sex = $_POST["sex"];
    $work = $_POST["work"];
    $email = $_POST["email"];
    $year = $_POST["year"];
    //连接数据库参数：地址、用户名、密码
    mysql_connect("localhost","root",123456);
   // 选择哪个数据库
   mysql_select_db("edu");
   // 识别中文字符
   mysql_query("SET NAMES UTF8");
   if($num==null&&$name==null&&$age==null&&$sex==null&&$work==null&&$email==null&&$year==null){
    echo "1";
    return false;
   }
    if($sex!=null){
    $sql2 = "SELECT * FROM teacher WHERE sex='$sex' "; }
   if($num!=null){
    $sql2 = "SELECT * FROM teacher WHERE num='$num' "; }
     if($name!=null){
    $sql2 = "SELECT * FROM teacher WHERE name='$name' "; } 
    if($age!=null){
    $sql2 = "SELECT * FROM teacher WHERE age='$age' "; }
    if($work!=null){
    $sql2 = "SELECT * FROM teacher WHERE work='$work' "; } 
    if($email!=null){
    $sql2 = "SELECT * FROM teacher WHERE email='$email' "; } 
    if($year!=null){
    $sql2 = "SELECT * FROM teacher WHERE year='$year' "; }
    //查询数据库
    $result=mysql_query($sql2);
    $i=false;
    $arr = array();
    // 循环
    while( $row = mysql_fetch_array($result) ){
        array_push($arr,$row);
          $i=true;
    }
    $allData = array("result"=>$arr);
    if($i){
    echo json_encode($allData);}
    else{
        echo "1";
    }
    ?>