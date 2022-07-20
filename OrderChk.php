<!DOCTYPE html>
<html lang="zh-TW">

	<head>
		<?php 
			session_start();
			
			if(!isset($_POST['SaveLngChange']))
				echo"<script  language=\"JavaScript\">alert('請從正確路徑進入');location.href=\"index.php\";</script>";	

		?>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<!-- SITE TITLE -->
		<title>食飯皇帝大</title>			
		<!-- Latest Bootstrap min CSS -->
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">		
		<!-- Google Font -->
		<link href='http://fonts.googleapis.com/css?family=Cousine:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,700,900,300' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<!-- flexslider CSS -->	
		<link rel="stylesheet" href="assets/css/flexslider.css">		
		<!-- venobox -->
		<link rel="stylesheet" href="assets/venobox/css/venobox.css" />
		<!---owl carousel Css-->
		<link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">	
		<!-- animate CSS -->	
		<link rel="stylesheet" href="assets/css/animate.css">		
		<!-- Style CSS -->
		<link rel="stylesheet" href="assets/css/style.css">	
		<!-- CSS FOR COLOR SWITCHER -->
		<link rel="stylesheet" href="assets/css/switcher/switcher.css"> 	
		<link rel="stylesheet" href="assets/css/switcher/style1.css" id="colors">		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	
    <body>

		<!-- START PRELOADER -->
		<div class="preloader">
			<div class="status">
				<div class="status-mes"></div>
			</div>
		</div>
		<!-- END PRELOADER -->			
		<!-- START NAVBAR -->
		<div class="navbar navbar-default navbar-fixed-top menu-top menu_dropdown">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">切換</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
					<a href="index.php" class="navbar-brand"><img src="assets/img/logo.png" alt="logo"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <nav>
						 <ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">首頁</a></li>
							
							<li><a href="order.php">線上點餐</a></li>
							<?php
								if(isset($_COOKIE['BearEat-Account'])){
									echo "<li><a href=\"OrderList.php\">點餐紀錄</a></li>";
									echo "<li><a href=\"manage.php\">後台管理</a></li>";
									echo "<li><a href=\"logout.php\">登出</a></li>";
								}
								else
								echo "<li><a href=\"login.php\">登入</a></li>";
							?>
						</ul>
					</nav>
                </div> 
            </div><!--- END CONTAINER -->
        </div> 	
		<!-- END NAVBAR -->	
		
		<!-- START  HOME DESIGN -->
		<section class="section-top" style="background-image: url(assets/img/bg/section-bg.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;">
			<div class="overlay">
				<div class="container">
					<div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
						<div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<h1>訂單確認</h1>
							<ol class="breadcrumb">
							  <li><a href="index.php">首頁</a></li>
							  <li class="active">訂單確認</li>
							</ol>
						</div><!-- //.HERO-TEXT -->
					</div><!--- END COL -->
				</div><!--- END CONTAINER -->
			</div><!--- END HOME OVERLAY -->
		</section>	
		<!-- END  HOME DESIGN -->	

		<!-- START CONTACT -->
		<section class="contact_area section-padding">
			<div class="container">	
				<div class="">	
					<div class="" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
						<div class="contact">
							<?php
								require("conn_mysql.php");
								$sql_Food="SELECT * FROM `foodtable` WHERE `Status`='1'";
								$res_Food=mysqli_query($db_link,$sql_Food)or die("sql_Lang查詢失敗");
							?>
							<form action="OrderChk.php" method="post" id="OrderChange">
								<table class="table table-Info table-hover table-bordered" style="text-align:center;font-size:18px;">
									<tr>
										<td>訂餐確認</td>
									</tr>	
									<!--產生訂單-->
									<?php		
										$ordersql="";		
										$orderchklist="";	
										$wronglist="";
										$TotalPrice=0;		
										$ordersuccess=true;						
										while($row_Food=mysqli_fetch_array($res_Food)){
											if(isset($_POST['count'.$row_Food['_ID']]) && $_POST['count'.$row_Food['_ID']]>0){//購買產品X
												$orderchklist=$orderchklist.$row_Food['Name'].$_POST['count'.$row_Food['_ID']]."份，";
												$TotalPrice+=(int)$_POST['count'.$row_Food['_ID']]*$row_Food['Price'];
											}
											if(isset($_POST['count'.$row_Food['_ID']]) &&  $_POST['count'.$row_Food['_ID']]>$row_Food['Mount']){
												$wronglist=$wronglist.$row_Food['Name']."，";
												$ordersuccess=false;
											}
										}	
										if($ordersuccess==true){//找了一輪確定可以訂餐
											$sql_Food="SELECT * FROM `foodtable` WHERE `Status`='1'";
											$res_Food=mysqli_query($db_link,$sql_Food)or die("sql_Lang查詢失敗");				
											while($row_Food=mysqli_fetch_array($res_Food)){
												if(isset($_POST['count'.$row_Food['_ID']]) && $_POST['count'.$row_Food['_ID']]>0){//購買產品X
													/*更新產品數量*/
													$updatemount="UPDATE `foodtable` SET `Mount`='".$row_Food['Mount']-$_POST['count'.$row_Food['_ID']]."' WHERE `_ID`='".$row_Food['_ID']."'";
													$res_updatemount=mysqli_query($db_link,$updatemount)or die("sql_Lang查詢失敗");			
												}
											}
											/*更新產品數量後 產生訂單*/
											$updateordertable="INSERT INTO `ordertable`(`GetDateTime`, `Name`, `Phone`, `OrderList`, `Price`, `Status`) VALUES ('";
											$updateordertable=$updateordertable.$_POST['GetDateTime']."','".$_POST['ordername']."','".$_POST['orderphone']."','".$orderchklist."','".$TotalPrice."','未取餐')";
											$res_updateordertable=mysqli_query($db_link,$updateordertable)or die("sql_Lang查詢失敗");		
										}	
									?>
									<tr>
										<td>
											<?php
												echo "您所預定的餐點為：".$orderchklist."共".$TotalPrice."元<br>";
												echo "訂購人：".$_POST['ordername']."<br>";
												echo "訂購人手機：".$_POST['orderphone']."<br>";
												echo "期望取餐時間：".$_POST['GetDateTime']."<br>";
											?>
										</td>
									</tr>
									<?php
										echo "<tr>";
											echo "<td align='right' colspan='8'>";
											if($ordersuccess==true)
											echo "<font color='blue'>訂單已收到</font>";
											else{
												echo "<font color='red'>".$wronglist."產品庫存不足，請確認後重新下訂</font>";
												echo " <button float='right' type='submit' form='OrderChange' class='btn btn-danger' name='StopOrder'>取消</button>";
											}
											echo "</td>";
										echo "</tr>";
										?>
								</table>
							</form>
						</div>
					</div><!-- END COL -->
				</div><!--- END ROW -->				
			</div><!--- END CONTAINER -->				
		</section>
		<!-- END CONTACT AREA -->	






		<!-- START FOOTER TOP-->
		<section class="footer-top">
			<div class="footer_overlay section-padding">	
				<div class="container">
					<div class="row">					
						<div class="col-md-4 col-sm-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
							<div class="single_footer">
								<h1>關於我們</h1>
								<p>店家簡介</p>
								<div class="footer_contact">
									<ul>
										<li><i class="fa fa-phone"></i> Call Us -  089-12345678</li>
										<li><i class="fa fa-rocket"></i> 店家地址</li>
									</ul>
								</div>
							</div>
						</div><!--- END COL -->
						<div class="col-md-2 col-sm-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
							<div class="single_footer">
							</div>
						</div><!--- END COL -->
						<div class="col-md-3 col-sm-6  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
							<div class="single_footer">
								<h1>我們的服務</h1>
								<ul>
									
									<li><a href="order.php">線上點餐</a></li>
									<?php
										if(isset($_COOKIE['BearEat-Account'])){//若有登入 跳轉離開
											echo "<li><a href=\"manage.php\">後台管理</a></li>";
											echo "<li><a href=\"logout.php\">登出</a></li>";
										}
										else
										echo "<li><a href=\"login.php\">登入</a></li>";
									?>
								</ul>
							</div>
						</div><!--- END COL -->
					</div><!--- END ROW -->
				</div><!--- END CONTAINER -->
			</div><!--- END OVERLAY -->
		</section>
		<!-- END FOOTER TOP -->		
		<!-- START FOOTER BOTTOM -->
		<footer class="footer section-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center  wow zoomIn">
						<div class="footer_social">
							<ul>
								<li><a class="f_facebook  wow bounceInDown" href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a class="f_twitter wow bounceInDown" data-wow-delay=".1s" href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a class="f_google wow bounceInDown" data-wow-delay=".2s" href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a class="f_linkedin wow bounceInDown" data-wow-delay=".3s" href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a class="f_youtube wow bounceInDown" data-wow-delay=".4s" href="#"><i class="fa fa-youtube"></i></a></li>
								<li><a class="f_skype wow bounceInDown" data-wow-delay=".5s" href="#"><i class="fa fa-skype"></i></a></li>
							</ul>
						</div>
						<p class="footer_copyright">Copyright &copy; 2020.Company Bear All rights reserved.</p>						
					</div><!--- END COL -->
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</footer>
		<!-- END FOOTER BOTTOM-->	

		<!-- Latest jQuery -->
        <script src="assets/js/jquery-1.11.3.min.js"></script>
		<!-- Latest compiled and minified Bootstrap -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- scrolltopcontrol js -->
		<script src="assets/js/scrolltopcontrol.js"></script>
		<!-- flexslider js -->
        <script src="assets/js/jquery.flexslider.js"></script>		
		<!-- venobox js -->
		<script src="assets/venobox/js/venobox.min.js"></script>
		<!-- jquery mixitup min js -->
        <script src="assets/js/jquery.mixitup.js"></script>
		<!-- countTo js -->
		<script src="assets/js/jquery.countTo.js"></script>
		<script src="assets/js/jquery.inview.min.js"></script>
		<!-- owl-carousel min js  -->
		<script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
		<!-- WOW - Reveal Animations When You Scroll -->
        <script src="assets/js/wow.min.js"></script>
		<!-- switcher js -->
        <script src="assets/js/switcher.js"></script>			
		<!-- scripts js -->
        <script src="assets/js/scripts.js"></script>
		<script type="text/javascript">
		$(".partner").owlCarousel({
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
		});
		</script>
    </body>
</html>