<?php
	session_start();
	//检测是否登录和用户权限，不符合进入条件转入首页
	if(!isset($_SESSION['username'])){
		header("Location:../../login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../../public/static/css/header.css"> 
	<title>Upload</title>
	<style>
		body{
			background-color: #eee;
		}
		.upload{
			min-height: 560px;
			padding-top: 50px;
			background: #e5e5e5;
		}
		.div-upload{
			/*margin: 15px;*/
			background: #ddd;
			/*width: 250px;*/
			min-height: 480px;
			display: inline-block;
		}
	</style>
</head>
<body>
	<?php include '../../header.php';?>
	<div class="upload container">
		<div id="uploadImg" class="div-upload col-md-4">
			<form id="form-uploadImg" enctype="multipart/form-data">
				<div class="form-group">
					<label for="img">图片</label>
					<input type="file" id="img" name="img">
					<p class="help-block">png/jpg/jpeg</p>
				</div>
				<button type="button" class="btn btn-info" onclick="uploadImg();">上传图片</button>
				<!-- <button type="submit" class="btn btn-info">上传图片</button> -->
			</form>
		</div>
		<div id="uploadDoc" class="div-upload col-md-4">
			<form id="form-uploadDoc"  enctype="multipart/form-data">
				<div class="form-group">
					<label for="doc">文档</label>
					<input type="file" id="doc" name="doc">
					<p class="help-block">doc/ppt/excl</p>
				</div>
				<div class="form-group">
					<label for="keywords">关键字</label>
					<input type="text" id="keywords" name="keywords" class="form-control">
					<p class="help-block">关于上传文档的描述</p>
				</div>
				<button type="button" class="btn btn-info" onclick="uploadDoc();">上传文档</button>
			</form>
		</div>
		<div id="uploadVideo" class="div-upload col-md-4">
			<form id="form-uploadVidoe" enctype="multipart/form-data">
				<div class="form-group">
					<label for="video">视频</label>
					<input type="file" id="video" name="video">
					<p class="help-block">mp4</p>
				</div>
				<div class="form-group">
					<label for="videoCover">封面</label>
					<input type="file" id="videoCover" name="videoCover">
					<p class="help-block">png/jpg/jpeg</p>
				</div>
				<div class="form-group">
					<label for="video_keywords">关键字</label>
					<input type="text" id="video_keywords" name="video_keywords" class="form-control">
					<p class="help-block">关于上传视频的描述</p>
				</div>
				<button type="button" class="btn btn-info" onclick="uploadVideo();">上传视频</button>
			</form>
		</div>
	</div>
	<div class="container" style="background: #ccc;">
		<div id="output"></div>
		<button type="button" class="btn btn-default" onclick="showpic()">显示图片</button>
	</div>
	<?php include '../../footer.php';?>
	<script src="../../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../../public/static/js/bootstrap.min.js"></script>
	<script src="../../public/static/js/header.js"></script>
	<script type="text/javascript">
	function showpic(){
		$.ajax({
			url: "../../admin/do_upload.php?action=show",	//需要请求的php路径
			success: function(data){
				if(data.success==1){		//根据返回的数据做不同处理
					var outdiv=document.getElementById("output");
					outdiv.innerHTML="";
					for(i=0;i<data.length;i++){
						// console.log(data[i].id);
						outdiv.innerHTML=outdiv.innerHTML+"<img src='../images/"+data[i].id+data[i].extension_name+"' width='480px' height='270px' style='margin:25px;'/><br/>";
						
					}
				}//alert(data);
			}
		});
	}/*showpic();*/
	function uploadImg(){
		$.ajax({
			url: '../../admin/do_upload.php?action=upload_img',
			type: 'POST',
			cache: false,
			data: new FormData($('#form-uploadImg')[0]),
			processData: false,
			contentType: false
		}).done(function(data) {
			console.log(data);
			alert(data.msg);
			location.reload();
		}).fail(function(data) {});
	}
	function uploadDoc(){
		/*$.ajax({
			url: "../../admin/do_upload.php?action=upload_doc",
			success:function(data){
				if (data.success==1) {
					document.getElementById('output').innerHTML=data.msg;
				}
			}
		});*/
		$.ajax({
			url: '../../admin/do_upload.php?action=upload_doc',
			type: 'POST',
			cache: false,
			data: new FormData($('#form-uploadDoc')[0]),
			processData: false,
			contentType: false
		}).done(function(data) {
			console.log(data);
			alert(data.msg);
			location.reload();
		}).fail(function(data) {});
	}
	function uploadVideo(){
		$.ajax({
			url: '../../admin/do_upload.php?action=upload_video',
			type: 'POST',
			cache: false,
			data: new FormData($('#form-uploadVidoe')[0]),
			processData: false,
			contentType: false
		}).done(function(data) {
			console.log(data);
			alert(data.msg);
			location.reload();
		}).fail(function(data) {});
	}
	</script>
</body>
</html>