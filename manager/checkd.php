<?php
$username=$_GET["username"];
mysql_connect("localhost","root",123456);
mysql_select_db("edu");
mysql_query("SET NAMES UTF8");
$sql = "SELECT * FROM user WHERE username ='{$username}'";
$result = mysql_query($sql);
// 输出结果的个数
$tiaomu = mysql_num_rows($result);
if( $tiaomu > 0){
echo "1";
}else{
echo "0";
}
?>