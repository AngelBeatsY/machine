<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<title><?php echo explode('.', $_GET['original_name'])[0];?></title>
	<style type="text/css">
		body { 
			font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
			background-color: #eee;
		}
		.jumbotron{
			color: #666;
			background-color: rgba(255,255,255,0.6);
			background: url(../public/static/images/doc-jumbotron.png) no-repeat 0 -200px;
			background-size: cover;
			opacity: 0.7;
		}
		iframe{
	 		width: 800px;
	 		height: 600px;
 		}
 		.div-pdf{
 			margin-top: 25px;
 			padding-top: 50px;
 			padding-bottom: 50px;
 			text-align: center;
 			background: rgba(255,255,255,0.6);
 		}
 		.pdf-list{
 			text-align: left;
 		}
 		.pdf-list ul{
 			list-style: none;
 		}
 		.pdf-list li{
			height: 34px;
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
	<div class="div-pdf container">
		<!-- pdf预览 -->
		<div class="pdf-content col-md-10">
			<iframe src="../public/file/preview_pdf/default.pdf" frameborder="0" id="pdfContainer" name="pdfContainer"></iframe>
		</div>
		<div class="list-group col-md-2">
			<span class="list-group-item active">热 门</span>
			<a href="../public/file/preview_pdf/mei.pdf" class="list-group-item" target="pdfContainer" onclick="showPdf()">小美</a>
			<a href="../public/file/preview_pdf/mercy.pdf" class="list-group-item" target="pdfContainer" onclick="showPdf()">天使</a>
			<a href="../public/file/preview_pdf/tracer.pdf" class="list-group-item" target="pdfContainer" onclick="showPdf()">裂空</a>
			<a href="../public/file/preview_pdf/widowmaker.pdf" class="list-group-item" target="pdfContainer" onclick="showPdf()">黑百合</a>
			<a href="download.php" class="list-group-item">更多>></a>
		</div>
	</div>
	<div id="comment-mod" class="">
		<!-- 评论模块 -->
		<?php include '../public/mod/comment-mod.php';?>
	</div>
	<?php include '../footer.php';?>
	<script src="../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../public/static/js/bootstrap.min.js"></script>
	<script src="../public/static/js/header.js"></script>
	<script src="js/pdf.js"></script>
	<script type="text/javascript">
		$(function(){  
			$("#navbar-collapse li:contains(文档)").addClass("active");
			$("#navbar-collapse li:contains(文档) span").removeClass("glyphicon-folder-close");
			$("#navbar-collapse li:contains(文档) span").addClass("glyphicon-folder-open");
		});
	
	//显示pdf
	function showPdf(){
		//var arr = location.href.split("?")[1];
        //var url = arr.split("=")[1];
		
		PDFJS.workerSrc = 'js/pdf.worker.js';//加载核心库
		PDFJS.getDocument(url).then(function getPdfHelloWorld(pdf) {
		//
		// 获取第一页数据
		//
		pdf.getPage(1).then(function getPageHelloWorld(page) {
		var scale = 1.5;
		var viewport = page.getViewport(scale);

		//
		// Prepare canvas using PDF page dimensions
		//
		var canvas = document.getElementById('the-canvas');
		var context = canvas.getContext('2d');
		canvas.height = viewport.height;
		canvas.width = viewport.width;

		//
		// Render PDF page into canvas context
		//
		var renderContext = {
		canvasContext: context,
		viewport: viewport
		};
		page.render(renderContext);
		});
		});

	}
	function jump() {
	//处理跳转至本页面的链接
		str = location.search.split("&");
		if (str[0] == "?flag=true"){
			pdfname = str[1].split("=")[1]+".pdf";
			document.getElementById("pdfContainer").src = "../public/file/preview_pdf/"+pdfname;
		}
		// alert(pdfname);
	}
	$(function(){
		jump();
	});

	</script>
</body>
</html>