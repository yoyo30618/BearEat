<?php
	#連線資料庫 
	include "conn_mysql.php";
	$sql_Lang="SELECT * FROM `ordertable` WHERE 1";
	$res_Lang=mysqli_query($db_link,$sql_Lang)or die("sql_Lang查詢失敗");
	$Find=false;
	while($row_Lang=mysqli_fetch_array($res_Lang)){
		if(isset($_POST['FinishStatus'.$row_Lang['_ID']]))//結束單
		{	
			$sql_SetAllLang="UPDATE `ordertable` SET `Status`='已取餐' WHERE `_ID`=".$row_Lang['_ID'];
			$res_sql_SetAllLang=mysqli_query($db_link,$sql_SetAllLang)or die("sql_Lang查詢失敗");
			$Find=true;
			echo"<script  language=\"JavaScript\">location.href=\"Orderlist.php\";</script>";				
		}
		else if(isset($_POST['FixStatus'.$row_Lang['_ID']]))//更正單
		{
			$sql_SetAllLang="UPDATE `ordertable` SET `Status`='未取餐' WHERE `_ID`=".$row_Lang['_ID'];
			$res_sql_SetAllLang=mysqli_query($db_link,$sql_SetAllLang)or die("sql_Lang查詢失敗");
			$Find=true;
			echo"<script  language=\"JavaScript\">location.href=\"Orderlist.php\";</script>";				
		}
		else if(isset($_POST['CancelStatus'.$row_Lang['_ID']]))//取消單
		{
			$sql_SetAllLang="UPDATE `ordertable` SET `Status`='已取消' WHERE `_ID`=".$row_Lang['_ID'];
			$res_sql_SetAllLang=mysqli_query($db_link,$sql_SetAllLang)or die("sql_Lang查詢失敗");
			$Find=true;
			echo"<script  language=\"JavaScript\">location.href=\"Orderlist.php\";</script>";	
					
		}
	}
	if($Find==false)
		echo"<script  language=\"JavaScript\">alert('請從正確路徑進入');location.href=\"index.php\";</script>";	
			
?>