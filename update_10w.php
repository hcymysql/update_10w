<?php

/*
第一步，得到起始ID
select id,create_time from t1 WHERE create_time>'2022-04-28 00:00:00' and  create_time<'2022-04-29 00:00:00' order by create_time asc limit 10;

第二步，得到结尾ID
select id,create_time from t1 WHERE create_time>'2022-04-28 00:00:00' and  create_time<'2022-04-29 00:00:00' order by create_time desc limit 10;

业务方SQL：
UPDATE t1 SET report_status=0 WHERE create_time>'2022-04-28 00:00:00' and  create_time<'2022-04-29 00:00:00';
*/

#起始ID
$begin_Id = 3188708841;

#结尾ID
$max_Id = 3207131498;

$mysql_server='192.168.32.67';
$mysql_username='yourname'; 
$mysql_password='yourpasswd';
$mysql_database='yourdb';
$mysql_port='3306';
$mysql_table='t1';
###############################################

$conn=mysqli_connect($mysql_server,$mysql_username,$mysql_password,$mysql_database,$mysql_port) or die("error connecting");

if (!$conn){
	die("连接错误: " . mysqli_connect_error());
}

mysqli_query($conn,"set names 'utf8'"); 


while(1==1){
$update = "UPDATE t1 SET report_status=0 WHERE id>=".$begin_Id." AND id<=".($begin_Id=$begin_Id+100000)." LIMIT 100000";
echo $update . PHP_EOL;

mysqli_query($conn,"SET tx_isolation = 'REPEATABLE-READ'");

$result = mysqli_query($conn,$update);

if ($result) {
    if(mysqli_affected_rows($conn)>=1){
            echo "". PHP_EOL;
	echo "t1表更改的行数是: " . mysqli_affected_rows($conn) . PHP_EOL;
	sleep(1);
    }
    else if($begin_Id<$max_Id){
	continue;
    }
   else{
	echo "t1表数据更改成功". PHP_EOL;
	break;
   }
}

}

?>
