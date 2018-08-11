<?php
	header("Content-type:text/html;charset=utf-8"); 
	// $file_name="1.jpg"; 
	$file_name= $_GET['name'];
	$original_name = $_GET['original_name'];
	echo $file_name;
	//用以解决中文不能显示出来的问题 
	$file_name=iconv("utf-8","gb2312",$file_name); 
	$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/machine/public/file/"; 
	$file_path=$file_sub_path.$file_name; 
	//首先要判断给定的文件存在与否 
	if(!is_file($file_path)){ 
		echo "没有该文件"; 
		return ;
	} 
	$fp=fopen($file_path,"r"); 
	$file_size=filesize($file_path);
	//下载文件需要用到的头 
	header("Content-type: application/octet-stream"); 
	header("Accept-Ranges: bytes"); 
	header("Content-Length:".$file_size); 
	header("Content-Disposition: attachment; filename=".$original_name);
	$buffer=1024; 
	$file_count=0; 
	//向浏览器返回数据 
	while(!feof($fp) && $file_count<$file_size){ 
		$file_con=fread($fp,$buffer); 
		$file_count+=$buffer; 
		echo $file_con; 
	} 
	fclose($fp);
?>