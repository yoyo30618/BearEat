<?php
	if(isset($_POST['FoodPhotoAdd'])){//儲存照片

		if($_FILES['myfile']['error']>0){
			echo "檔案上傳失敗";
		}
		else
		{
			$filename=$_POST['filename'];
			move_uploaded_file($_FILES['myfile']['tmp_name'], 'assets/img/food/'.$filename.'.jpg');
			echo"<script  language=\"JavaScript\">alert('照片上傳完畢');location.href=\"manage.php\";</script>";	
		}
	}
	else
		echo"<script  language=\"JavaScript\">alert('請從正確路徑進入');location.href=\"index.php\";</script>";	
			
?>