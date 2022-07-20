<?php
	header("Content-Type:text/html;charset=utf-8");//設定編碼
	session_start();//開啟session
	if(isset($_POST['loginform']))//如果是由post進入
	{
		$Account = $_POST['Account'];
		$Password = $_POST['Password'];
		if(($Account=='')||($Password==''))//空白帳密
			echo"<script  language=\"JavaScript\">alert('使用者名稱或密碼不能為空');location.href=\"login.php\";</script>";
		require("conn_mysql.php");
		$sql_query_login="SELECT * FROM AccountTable where Account='$Account'";
		// print($sql_query_login);
		$Pwd_result=mysqli_query($db_link,$sql_query_login) or die("查詢失敗");//查詢帳密
		while($row=mysqli_fetch_array($Pwd_result))
		{
			if($row['Password']==$Password)//登入成功
			{

				$_SESSION['BearEat-Account']=$Account;//登入成功將資訊儲存到session中
				$_SESSION['BearEat-Islogin']=1;
				setcookie("BearEat-Account",$Account);
				setcookie("BearEat-Islogin","1");
				header('refresh:0;url=manage.php');
				break;
			}
			else//密碼錯誤登入失敗
				echo"<script  language=\"JavaScript\">alert('使用者名稱或密碼錯誤');location.href=\"login.php\";</script>";
		}
		if(!isset($_SESSION['BearEat-Account']))//都找不到代表沒帳號
			echo"<script  language=\"JavaScript\">alert('使用者名稱或密碼錯誤');location.href=\"login.php\";</script>";
	}
	else//不當路徑進入
		echo"<script  language=\"JavaScript\">alert('請由正確路徑進入');location.href=\"login.php\";</script>";
		
?>