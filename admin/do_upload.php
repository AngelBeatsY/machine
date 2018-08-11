<?php
if(!isset($_GET['action'])){$_GET['action']='null';}
if($_GET['action']=='show'){
	show();
}
elseif ($_GET['action']=='upload_img') {
	$up_img = $_FILES['img'];
	echo upload_img($up_img);
}
elseif ($_GET['action']=='upload_doc') {
	$up_doc = $_FILES['doc'];
	echo upload_doc($up_doc);
}
elseif ($_GET['action']=='upload_video') {
	$up_video = $_FILES['video'];
	$up_videoCover = $_FILES['videoCover'];
	echo upload_video($up_video,$up_videoCover);
}
else{
	echo "error";
}

function show(){
	//返回所有上传文件
	$ret = array();
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	include($rootpath.'/machine/admin/connSql.php');
	$sql = "select * from pic";
	$result = $pdo -> query($sql);
	$row = $result -> fetchAll();
	/*for($i=0;$i<count($row);$i++){
		$ret[$i]['url'] = $row[$i]['url'];
	}*/
	$ret = $row;
	$ret['length'] = count($row);
	$ret['success'] = 1;
	$ret['msg'] = '调用php成功';
	header('content-type:application/json');
	echo json_encode($ret);
}
function upload_img($up_img){
	//图片上传
	$ret = array();
	if ($up_img['name'] != '') {
		if ($up_img['error'] > 0) {  
			$ret['msg'] = "上传失败";  
		}  
		else {
			switch ($up_img['type'])
			{
				case "image/jpeg":
					$fileextname = "jpg";
					break;
				case "image/pjpeg":
					$fileextname = "jpg";
					break;
				case "image/gif":
					$fileextname = "gif";
					break;
				case "image/png":
					$fileextname = "png";
					break;
				case "image/x-png":
					$fileextname = "png";
					break;
				default:
					$fileextname = "null";
					break;
				/*case "application/x-shockwave-flash":
					$fileextname = "swf";
					break;
				case "text/plain":     
					$fileextname = "txt";
					break;
				case "application/msword":
					$fileextname = "doc";
					break;
				case "application/x-zip-compressed":
					$fileextname = "zip";
					break;*/
			}
			$id = date("Ymdis");
			$ret['id'] = $id;
			$extension_name = ".".$fileextname;
			$ret['extension_name'] = $extension_name;
			$filename = $id.".".$fileextname;
			$fileurl = "../public/images/".$filename;
			if (move_uploaded_file($up_img['tmp_name'] , $fileurl)) {  
				$rootpath = $_SERVER['DOCUMENT_ROOT'];
				include($rootpath.'/machine/admin/connSql.php');
				$sql = "insert into pic (id,extension_name) values ('$id','$extension_name')"; //url插入数据库
				$result = $pdo->prepare($sql);
				$result -> execute();
				$pdo = null;//关闭连接
				$ret['msg'] = "上传成功";
				$ret['msg'] =$ret['msg'].$filename." ".$fileurl;
			}  
			else {  
				$ret['msg'] = "上传失败";  
			}  
		}  
	}  
	else {  
		$ret['msg'] = "请上传文件";  
	}
	header('content-type:application/json');
	return json_encode($ret);
}
function upload_doc($up_doc){
	//上传文档
	$ret = array();
	$pid = date("Ymdis");
	$original_name = $up_doc['name'];
	$ret['file'] = $original_name;
	switch ($up_doc['type']) {
		case "application/msword":
			$fileextname = "doc";
			break;
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			$fileextname = "docx";
			break;
		case 'application/vnd.ms-excel':
			$fileextname = "xls";
			break;
		case 'application/x-excel':
			$fileextname = "xls";
			break;
		case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			$fileextname = "xlsx";
			break;
		case 'application/vnd.ms-powerpoint':
			$fileextname = "ppt";
			break;
		case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
			$fileextname = "pptx";
			break;
		default:
			$fileextname = "null";
			break;
	}
	$original_name = explode(".".$fileextname, $original_name)[0];
	$extension_name = ".".$fileextname;
	$keywords = $_POST['keywords'];
	$filename = $pid.".".$fileextname;
	$fileurl = "../public/file/".$filename;
	if(move_uploaded_file($up_doc['tmp_name'] , $fileurl)){
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include($rootpath.'/machine/admin/connSql.php');
		$sql = "insert into doc (pid,original_name,extension_name,keywords) values 
			('$pid','$original_name','$extension_name','$keywords')"; //doc信息插入数据库
		$result = $pdo->prepare($sql);
		$result -> execute();
		exec("cd /d D:\Soft\LibreOffice 5\program && soffice.exe --convert-to pdf:writer_pdf_Export --outdir $rootpath/machine/public/file/preview_pdf/ $rootpath/machine/public/file/$filename",$res,$info);
		$ret['doc2pdf'] = "doc2pdf转换状态".$info;
		$ret['success'] = 1;
		$ret['msg'] = '上传成功';
	}
	$ret['original_name'] = $original_name;
	header('content-type:application/json');
	return json_encode($ret);
}
function upload_video($up_video,$up_videoCover){
	$ret = array();
	if($up_videoCover['name'] != ''){
		$cover = json_decode( upload_img($up_videoCover),true );
		$pid = $cover['id'];
		$covername = $cover['id'].$cover['extension_name'];
	}
	else{
		$covername = "video_cover.jpg";
		$pid = date("Ymdis");
	}
	$keywords = $_POST['video_keywords'];
	$original_name = $up_video['name'];
	$ret['file'] = $original_name;
	switch ($up_video['type']) {
		case "video/mp4":
			$fileextname = "mp4";
			break;
		default:
			$fileextname = "null";
			break;
	}
	$filename = $pid.".".$fileextname;
	$original_name = explode(".".$fileextname, $original_name)[0];
	$extension_name = ".".$fileextname;
	$fileurl = "../public/video/".$filename;
	if (move_uploaded_file($up_video['tmp_name'] , $fileurl)) {
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include($rootpath.'/machine/admin/connSql.php');
		$sql = "insert into video (pid,original_name,extension_name,keywords,cover) values 
			('$pid','$original_name','$extension_name','$keywords','$covername')"; //doc信息插入数据库
		$result = $pdo->prepare($sql);
		$result -> execute();
		$ret['success'] = 1;
		$ret['msg'] = '上传成功';
	}

	$ret['type'] = $up_video['type'];
	$ret['cover'] = $up_videoCover['name'];
	header('content-type:application/json');
	return json_encode($ret);
}
?>