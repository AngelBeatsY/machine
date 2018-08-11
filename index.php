<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="public/static/css/header.css"> 
	<link rel="stylesheet" href="public/static/css/course.css"> 
	<title>Machine</title>
	<style type="text/css">
		body { 
			font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
			background-color: #eee;
		}
		.carousel-inner .item img { margin: 0 auto; } 
		.frosted-glass{
			/*毛玻璃*/
			width:100%;
			height: 100%;
			opacity: 1;
			position: absolute;top: 0;
			-webkit-filter: blur(5px);   
        	-moz-filter: blur(5px);   
        	-ms-filter: blur(5px);   
        	-o-filter: blur(5px);
			filter: blur(5px);
			z-index: -1;
		}
		.carousel-control { font-size: 100px; }
		#myCarousel img{ width: 720px;height: auto; }

		.tab-h2{ text-align: center; font-size: 20px;}
		.tab-p{ text-align: center; font-size: 15px;}
		.tab1{ margin: 30px 0;color: #666; }
		.tab1 .media-top{overflow: hidden;}
		.tab1 img{ width: 90px;height: auto; transition:all 0.6s;}
		.tab1 img:hover {transform:scale(1.5);}
		.tab1 .media-heading {margin: 5px 0 20px 0; }
		.tab1 .col { padding: 20px; }

		/* 小屏幕（平板，大于等于 768px） */ 
		@media (min-width: 768px) { 
			.tab-h2 { font-size: 26px; } 
			.tab-p { font-size: 16px; } 
		}
		/* 中等屏幕（桌面显示器，大于等于 992px） */ 
		@media (min-width: 992px) { 
			.tab-h2 { font-size: 28px; } 
			.tab-p { font-size: 17px; } 
		}
		/* 大屏幕（大桌面显示器，大于等于 1200px） */ 
		@media (min-width: 1200px) { 
			.tab-h2 { font-size: 30px; } 
			.tab-p { font-size: 18px; } 
		}
	</style>
</head>
<body>
	<?php include 'header.php';?>
	<div id="myCarousel" class="carousel slide">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active">
				<a href="#"><img src="public/static/images/slide1.jpg" alt="第一张"></a>
				<div class="frosted-glass" style="background: url(public/static/images/slide1.jpg) no-repeat;background-size: cover;">
				</div>
			</div>
			<div class="item">
				<a href="#"><img src="public/static/images/slide2.jpg" alt="第二张"></a>
				<div class="frosted-glass" style="background: url(public/static/images/slide2.jpg) no-repeat;background-size: cover;">
				</div>
			</div> 
			<div class="item"> 
				<a href="#"><img src="public/static/images/slide3.jpg" alt="第三张"></a> 
				<div class="frosted-glass" style="background: url(public/static/images/slide3.jpg) no-repeat;background-size: cover;">
				</div>
			</div> 
		</div> 
		<a href="#myCarousel" data-slide="prev" class="carousel-control left">&lsaquo;</a> 
		<a href="#myCarousel" data-slide="next" class="carousel-control right">&rsaquo;</a>
	</div>
	<div class="container">
		<div class="row">
			<h2 class="tab-h2">「 课程介绍 」</h2>
			<p class="tab-p">本课程是培养学生设计能力的技术基础课，是机械类各专业的主要课程。</p> 
			<p class="tab-p">“机械设计”是机械类专业学生的一门重要专业基础课，为满足服务地方经济需要，
			<p class="tab-p">按照机械设计制造及其自动化专业的建设热开设的。</p> 
			<p class="tab-p">制造业是国民经济的支柱产业，国民经济的总收入的60%来自制造业，世界发达国家无不具有强大的制造业。</p> 
			<p class="tab-p">机械制造业是制造业基础，是重中之重。</p> 
		</div>
	</div>
	<div class="tab1">
		<div class="container">
			<div class="row">
				<h2 class="tab-h2">「 名师大咖 」</h2>
				<p class="tab-p">强大的师资力量，完美的实战型管理课程，让您实现质的腾飞！</p> 
				<div class="col-md-4 col-sm-6 col">
					<div class="media"> 
						<div class="media-left media-top"> 
							<a href="#"> <img class="media-object" src="public/static/images/teacher1.png" alt="..."> </a> 
						</div> 
						<div class="media-body"> 
							<h4 class="media-heading">姜安庆</h4> 
							<p class="text-muted">住建部土建类教学指导委员会规划教材编审委员会委员</p>
							<p>基于PLC控制的轮毂抛光系统及其关键技术研究负责人</p> 
						</div> 
					</div> 
				</div>
				<div class="col-md-4 col-sm-6 col">
					<div class="media"> 
						<div class="media-left media-top"> 
							<a href="#"> <img class="media-object" src="public/static/images/teacher2.png" alt="..."> </a> 
						</div> 
						<div class="media-body"> 
							<h4 class="media-heading">李涛</h4> 
							<p class="text-muted">柔性并联机器人复合振动控制与载荷相关运动精度可靠性研究</p>
							<p>蛋白质近天然结构并行筛选关键技术研究, 纵向项目</p> 
						</div> 
					</div> 
				</div>
				<div class="col-md-4 col-sm-6 col">
					<div class="media"> 
						<div class="media-left media-top"> 
							<a href="#"> <img class="media-object" src="public/static/images/teacher3.png" alt="..."> </a> 
						</div> 
						<div class="media-body"> 
							<h4 class="media-heading">刘万祥</h4> 
							<p class="text-muted"> 机械工程学院副院长，教授、博士生导师。</p>
							<p>工作静轨迹反求旋转式分插机构齿轮节曲线</p> 
						</div> 
					</div> 
				</div>
				<div class="col-md-4 col-sm-6 col">
					<div class="media"> 
						<div class="media-left media-top"> 
							<a href="#"> <img class="media-object" src="public/static/images/teacher4.png" alt="..."> </a> 
						</div> 
						<div class="media-body"> 
							<h4 class="media-heading">侯捷</h4> 
							<p class="text-muted">机械工程学院机械工学部主任，副教授，硕士生导师。</p>
							<p>级青年教师教学技能大赛，学院一等奖</p> 
						</div> 
					</div> 
				</div>
				<div class="col-md-4 col-sm-6 col">
					<div class="media"> 
						<div class="media-left media-top"> 
							<a href="#"> <img class="media-object" src="public/static/images/teacher5.png" alt="..."> </a> 
						</div> 
						<div class="media-body"> 
							<h4 class="media-heading">陈明旺</h4> 
							<p class="text-muted">机械工程学院副院长，教授、博士生导师。</p>
							<p>内啮合圆弧-摆线液压马达结构设计及仿真</p> 
						</div> 
					</div> 
				</div>
				<div class="col-md-4 col-sm-6 col">
					<div class="media"> 
						<div class="media-left media-top"> 
							<a href="#"> <img class="media-object" src="public/static/images/teacher6.png" alt="..."> </a> 
						</div> 
						<div class="media-body"> 
							<h4 class="media-heading">叶梓</h4> 
							<p class="text-muted">机械工程学院教授。</p>
							<p>低速大扭矩液压马达的机构设计</p> 
						</div> 
					</div> 
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<h2 class="tab-h2">「 精品视频 」</h2>
			<p class="tab-p">强大的师资力量，完美的实战型管理课程，让您实现质的腾飞！</p> 
		</div>
	</div>
	<div id="course-mod">
		<!-- 课程视频模块 -->
		<?php require 'course/mod/course-mod.php';?>
	</div>
	<?php include 'footer.php';?>
	<script src="public/static/js/jquery-3.1.1.min.js"></script>
	<script src="public/static/js/bootstrap.min.js"></script>
	<script src="public/static/js/header.js"></script>
	<script type="text/javascript">
		//navbar样式选择
		$(function(){  
			$("#navbar-collapse li:contains(机械云课堂)").addClass("active");
		});
		$('#myCarousel').carousel({
			//设置自动播放/3 秒 
			interval : 3000, 
		});
		//调整轮播器箭头位置 
		$('.carousel-control').css('line-height', $('.carousel-inner img').height() + 'px'); 
		$(window).resize(function() { 
			var $height = 	$('.carousel-inner img').eq(0).height() ||
							$('.carousel-inner img').eq(1).height() ||
							$('.carousel-inner img').eq(2).height(); 
			$('.carousel-control').css('line-height', $height + 'px'); 
		});
		$(".m-media-wp-span").on({
			mouseover:function(){$(this).children(".video-keywords").css("display","block");},
			mouseout:function(){$(".video-keywords").css("display","none");}
		});
	</script>
</body>
</html>