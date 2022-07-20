<?php
	#連線資料庫 
	include "conn_mysql.php";
	$Find=false;
	$sql_Lang="SELECT * FROM `foodtable`";
	$res_Lang=mysqli_query($db_link,$sql_Lang)or die("sql_Lang查詢失敗");
	if(isset($_POST['SaveLngChange'])){//儲存整個修改
		while($row_Lang=mysqli_fetch_array($res_Lang)){
				$Name=$_POST['Name'.$row_Lang['_ID']];
				$Price=$_POST['Price'.$row_Lang['_ID']];
				$Mount=$_POST['Mount'.$row_Lang['_ID']];
				$Info=$_POST['Info'.$row_Lang['_ID']];
				$Status=0;
				if(isset($_POST['Status'.$row_Lang['_ID']]))
					$Status=1;

				$sql_SetAllLang="UPDATE  `beareat`.`foodtable` SET `Name`='".$Name."',`Price`='".$Price."',`Mount`='".$Mount."',`Info`='".$Info."',`Status`='".$Status."' WHERE `_ID`='".$row_Lang['_ID']."';";
				$res_sql_SetAllLang=mysqli_query($db_link,$sql_SetAllLang)or die("sql_Lang查詢失敗");
		}
		if($_POST['Name_New']!=""){//有新餐點
			if($_POST['Price_New']=="")
				$_POST['Price_New']="0";
			$sql_SetAllLang="INSERT INTO `foodtable`(`Name`, `Price`, `Mount`, `Status`, `Info`) VALUES ('".$_POST['Name_New']."','".$_POST['Price_New']."','0','1','".$_POST['Info_New']."');";
			// print($sql_SetAllLang);
			$res_sql_SetAllLang=mysqli_query($db_link,$sql_SetAllLang)or die("sql_Lang查詢失敗");
		}
		echo"<script  language=\"JavaScript\">alert('修正完畢');location.href=\"manage.php\";</script>";	
	}
	else
		echo"<script  language=\"JavaScript\">alert('請從正確路徑進入');location.href=\"index.php\";</script>";	
			
?>