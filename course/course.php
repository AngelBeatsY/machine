<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<link rel="stylesheet" href="../public/static/css/course.css"> 
	<title>Course</title>
	<style type="text/css">
		body { 
			font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
			background-color: #eee;
		}
		.jumbotron{
			color: #666;
			background-color: rgba(255,255,255,0.6);
			background: url(../public/static/images/course-jumbotron.jpg) no-repeat;
			background-size: cover;
			opacity: 0.7;
			/*filter: blur(2px);*/
		}
		
	</style>
</head>
<body>
	<?php include '../header.php';?>
	<div class="jumbotron">
		<div class="container">
			<blockquote><h1>&nbsp视&nbsp频</h1></blockquote>
		</div>
	</div>
	<div id="course-mod">
		<!-- 课程视频模块 -->
		<?php require 'mod/course-mod.php';?>
	</div>
	<?php include '../footer.php';?>
	<script src="../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../public/static/js/bootstrap.min.js"></script>
	<script src="../public/static/js/header.js"></script>
	<script type="text/javascript">
		//navbar样式选择
		$(function(){  
			$("#navbar-collapse li:contains(课程)").addClass("active");
		});
		/*$(".media-item").on({
			mouseover:function() {$(this).css("filter","blur(1.5px)");},
			mouseout:function(){$(this).css("filter","blur(0px)");}
		});*/
		$(".m-media-wp-span").on({
			mouseover:function(){$(this).children(".video-keywords").css("display","block");},
			mouseout:function(){$(".video-keywords").css("display","none");}
		});
	</script>
</body>
</html>