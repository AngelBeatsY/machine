<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<title>Doc</title>
	<style type="text/css">
		body { 
			font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
			background-color: #eee;
		}
		.jumbotron{
			color: #666;
			background-color: rgba(255,255,255,0.6);
			background: url(../public/static/images/doc-jumbotron.jpg) no-repeat 0 -200px;
			background-size: cover;
			opacity: 0.7;
		}
		.hot-info{
			min-height: 720px;
		}
		/*.info-content{
			background-color:#fff;
			box-shadow:2px 2px 3px #ccc;
			margin:20px 0;
			padding: 20px;
		}*/
		.list-group{
			text-align:center;
		}
		.row{
			margin: -1px 0;
		}
		.list-group .title{
			color: rgba(0,0,0,0.5);
			font-size: 18px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<?php include '../header.php';?>
	<div class="jumbotron">
		<!-- 巨幕 -->
		<div class="container">
			<blockquote><h1>&nbsp文&nbsp档</h1></blockquote>
		</div>
	</div>
	<div class="hot-info">
		<div class="container">
			<!-- <div class="info-content">
				<blockquote class="">热门下载</blockquote>
			</div> -->
			<div class="list-group">
				<div class="title list-group-item row">
					<div class="col-md-10">
						<span class="col-md-4">文档</span>
						<span class="col-md-6">关键字</span>
						<span class="col-md-2">上传时间</span>
					</div>
					<div class="col-md-2">
						<span class="glyphicon glyphicon-download-alt"></span>
					</div>
				</div>

				<!-- <div class="list-group-item row">
					<div class="col-md-10">
						<a href="doc-preview.php?flag=true&
							pid=201701015959&
							original_name=default.doc" class="col-md-4 ">文件名</a>
						<span class="col-md-6">关键字</span>
						<span class="col-md-2">上传时间</span>
					</div>
					<a href="/machine/admin/do_download.php?
						name=default.doc&
						original_name=default.doc" class="col-md-2">
						<span class="glyphicon glyphicon-download-alt"> 下 载</span>
					</a>
				</div> -->
		<?php 
			$rootpath = $_SERVER['DOCUMENT_ROOT'];
			include($rootpath.'/machine/admin/connSql.php');
			$sql = "select * from doc";	//查询文档
			$result = $pdo->query($sql);
			$row = $result->fetchAll();
			// var_dump($row);
			for($i=0;$i<count($row);$i++){
		?>
				<div class="list-group-item row">
					<div class="col-md-10">
						<a href="doc-preview.php?flag=true&
							pid=<?php echo $row[$i]['pid'];?>&
							original_name=<?php echo $row[$i]['original_name']?>" class="col-md-4">
							<?php echo $row[$i]['original_name']?>
						</a>
						<span class="col-md-6"><?php echo $row[$i]['keywords']?></span>
						<span class="col-md-2"><?php echo substr($row[$i]['time'], 0,10)?></span>
					</div>
					<a href="/machine/admin/do_download.php?
						name=<?php echo $row[$i]['pid'].$row[$i]['extension_name']?>&
						original_name=<?php echo $row[$i]['original_name'].$row[$i]['extension_name']?>" class="col-md-2">
						<span class="glyphicon glyphicon-download-alt"> 下 载</span>
					</a>
				</div>
		<?php
			}//endfor
		?>
			</div>
		</div>
	</div>
	<div class="uploadfile" style="position:absolute;top:200px;right:45px">
		<a href="../public/mod/upload-mod.php" class="btn btn-default">上传</a>
	</div>
	<?php include '../footer.php';?>
	<script src="../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../public/static/js/bootstrap.min.js"></script>
	<script src="../public/static/js/header.js"></script>
	<script type="text/javascript">
		$(function(){  
			$("#navbar-collapse li:contains(文档)").addClass("active");
			$("#navbar-collapse li:contains(文档) span").removeClass("glyphicon-folder-close");
			$("#navbar-collapse li:contains(文档) span").addClass("glyphicon-folder-open");
		});
	</script>
</body>
</html>