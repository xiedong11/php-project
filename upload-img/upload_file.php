<?php
	session_start();
	// $_SESSION["userid"]="zxh";
	if (1)//这个地方可以填写上传文件的限制，比如格式大小要求等，为了方便测试，这里没有写上传限制。
 	{
  		if ($_FILES["file"]["error"] > 0)
    	{
    		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";//获取文件返回错误
    	}
  		else
    	{
			//打印文件信息
    		echo "上传文件名: " . $_FILES["file"]["name"] . "<br />";//获取文件名
    		echo "类型: " . $_FILES["file"]["type"] . "<br />";//获取文件类型
    		echo "大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";//获取文件大小
    		echo "临时路径: " . $_FILES["file"]["tmp_name"] . "<br />";//获取文件临时地址
			
			//自定义文件名称
			$array=$_FILES["file"]["name"];
			$array=explode(".",$array);
			$newfilename=$_SERVER['REQUEST_TIME'];//自定义文件名（测试的时候中文名会操作失败）
			$_FILES["file"]["name"]=$newfilename.".".$array[1];
			
			// if (!is_dir("upload/".$_SESSION["userid"]))//当路径不穿在
			// {
			// 	mkdir("upload/".$_SESSION["userid"]);//创建路径
			// }
			$url="upload/";//记录路径
    		if (file_exists($url.$_FILES["file"]["name"]))//当文件存在
      		{
      			echo $_FILES["file"]["name"] . " already exists. ";
      		}
    		else//当文件不存在
      		{
				$url=$url.$_FILES["file"]["name"];
      			move_uploaded_file($_FILES["file"]["tmp_name"],$url);
      			echo "存储地址: http://php.zhuandian.site/upload-img/" . $url;
      		}
    	}
 	 }
	else
 	{
		echo "Invalid file";
  	}
?>
 
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<br><br>
	<img src="<?php echo $url;?>">
</body>
</html>