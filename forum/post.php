<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<title>Post</title>
	<style type="text/css">
		body { 
			font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
			background: url(/machine/public/static/images/bg-img-comm.jpg) no-repeat fixed left;
			background-size: cover;
			/*background-color: #eee;*/
		}
		.jumbotron{
			 background-color: rgba(255,255,255,0.6);
		}
		#postlist .container{
			padding-top: 30px;
			margin-bottom: 30px;
			font-size: 15px;
			font-weight: bold;
			color: rgba(0,0,0,0.7);
			background-color: rgba(255,255,255,0.6);
		}
		.post-topic{
			margin-top: 0;
			margin-bottom: 30px;
			font-size: 30px;
		}
		.post-topic img{
			margin-right: 8px;
			width: 50px;
			height: 50px;
		}
		.table{
			margin-bottom: 0;
		}
		.table > tbody > tr > td{
			padding: 20px 0;
		}
		#postlist  .pls{
			text-align: center;
			color: rgba(0,0,0,0.7);
		}
		.userInfo{
			margin-top: 15px;
			height: 24px;
			line-height: 24px;
		}
		#postlist  .pct{
			color: rgba(0,0,0,0.7);
		}
		#postlist .post-info{
			padding-right: 15px;
			text-align: right;
		}
		.paging{
			text-align: center;
			font-size: 15px;
			font-weight: bold;
		}
		#cmt{
			padding-top: 15px;
			margin-bottom: 30px;
			font-size: 15px;
			font-weight: bold;
			color: rgba(0,0,0,0.7);
			background-color: rgba(255,255,255,0.6);
		}
		#cmt .table > tbody > tr >th,#cmt .table > tbody > tr >td{
			border-top: 0;
			border-bottom: 0;
		}
		.cmt-info{
			text-align: center;
		}
		.cmt-title{
			margin-bottom: 20px;
			padding-left: 15px;
		    font-size: 24px;
			text-align:left;
			font-weight: bold;
			color: rgba(0,0,0,0.5);
		}
		.avatar img{
			width: 80px;
			height: 80px;
		}
		.cmt-content{
			
		}
		#cmt textarea{
			resize:none;
		}
		.submit-btn{
			margin-top: 10px;
			margin-right: 5px;
			width: 150px;
			height: 40px;
			font-size: 18px;
			font-weight: bold;
			background: #f7931e;
		}
	</style>
</head>
<body>
	<?php //session_start();//开启session?>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/machine/header.php';//引入导航栏?>
	<div class="jumbotron">
		<div class="container">
			<blockquote><h1>综合讨论区</h1></blockquote>
		</div>
	</div>
	<div id="postlist">
		<!-- 评论列表 -->
		<div class="container">
	<?php
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include($rootpath.'/machine/admin/connSql.php');
		$sql = "select * from post where pid=".$_GET['pid'];	//查询帖子主题
		$result = $pdo->query($sql);
		$row = $result->fetch();
	?>
			<div class="post-topic">
				<img src="../public/static/images/logo.png" alt="logo">
				<span><?php echo $row['topic'];?></span>
			</div>
	<?php
		$page_limit = 5;
		if(isset($_GET['page'])){
			$offset = ($_GET['page']-1)*$page_limit;
		}
		else{
			$offset = 0;
		}
		$sql = "select * from comment where pid=".$_GET['pid']." order by id limit $offset,$page_limit";	//查询指定pid的文章评论
		$result = $pdo->query($sql);
		$row = $result->fetchAll();
		for($i=0;$i<count($row);$i++){
			$sql = "select avatar from account where username='".$row[$i]['username']."'";	//查评论者头像
			$result = $pdo->query($sql);
			$avatar = $result->fetch();
	?>
			<div id="postmessage_<?php echo $row[$i]['id'];?>" class="post-warpper">
				<table class="table">
					<tbody>
						<tr>
							<td class="pls col-md-3">
								<div class="avatar">
									<img src="/machine/public/images/avatar/<?php echo $avatar[0]?>" alt="avatar">
								</div>
								<div class="userInfo"><?php echo $row[$i]['username'];?></div>
							</td>
							<td class="pct col-md-6">
								<div class="post-content">
									<?php echo $row[$i]['content'];?>
								</div>
							</td>
							<td class="post-info col-md-3">
								<p><?php echo ($offset+$i+1).'#';?></p>
								<p><?php echo $row[$i]['time'];?></p>
								<p>回复</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	<?php 
		}//endfor
		$pdo = null;//关闭连接
	?>
			<div class="paging">
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<li>
							<a href="post.php?pid=<?php echo $_GET['pid']?>&page=<?php echo $offset/$page_limit>0?$offset/$page_limit:1?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
			<?php
				$rootpath = $_SERVER['DOCUMENT_ROOT'];
				include($rootpath.'/machine/admin/connSql.php');
				$sql = "select count(*) as count from comment where pid=".$_GET['pid'];	//查询指定帖子评论数量
				$result = $pdo->query($sql);
				$row = $result->fetch();
				$page_size = ceil($row['count']/$page_limit);
				for($i=0;$i<$page_size;$i++){
			?>
						<li>
							<a href="post.php?pid=<?php echo $_GET['pid']?>&page=<?php echo $i+1;?>">
								<?php echo $i+1;?>
							</a>
						</li>
			<?php
				}//endfor
				$pdo = null;//关闭连接
			?>
						<li>
							<a href="post.php?pid=<?php echo $_GET['pid']?>&page=<?php echo ($offset/$page_limit+2)<$page_size?($offset/$page_limit+2):$page_size?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div id="cmt" class="container post-warpper">
		<!-- 评论框 -->
		<table class="table">
			<tbody>
				<tr>
				<?php
					if(isset($_SESSION['username'])){
				?>
					<td class="cmt-info col-md-3">
						<div class="cmt-title">回复...</div>
						<div class="avatar">
							<img src="/machine/public/images/avatar/<?php echo $_SESSION['avatar'];?>" alt="avatar">
						</div>
						<div class="userInfo"><?php echo $_SESSION['username'];?></div>
					</td>
					<td class="cmt-content col-md-9">
						<div class="pct">
							<textarea class="form-control" rows="5" id="cmtContent"></textarea>
						</div>
						<p><button type="submit" class="btn submit-btn pull-right" onclick="CmtPost();">发表评论</button></p>
					</td>
				<?php
					}//endif
					else{
				?>
					<td class="cmt-content col-md-12">
						<p>
							<button class="btn submit-btn pull-right" 
								onclick="javascript:window.location.href='/machine/login.php'">发表评论
							</button>
						</p>
					</td>
				<?php
					}//endelse
				?>
				</tr>
			</tbody>
		</table>
	</div>
	<?php include '../footer.php';?>
	<script src="../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../public/static/js/bootstrap.min.js"></script>
	<script src="../public/static/js/header.js"></script>
	<script type="text/javascript">
	//navbar样式选择
	$(function(){  
		$("#navbar-collapse li:contains(论坛)").addClass("active");
	});

	function CmtPost(){
	//提交评论
		var cmtContent=$("#cmtContent");	//评论输入文本区
		//alert(cmtContent.val()==null);
		if(cmtContent.val()!==""){
			$.ajax({
				type: "POST",
				url: "../admin/do_comment.php",
				data: {pid:"<?php echo $_GET['pid'];?>" , content:cmtContent.val() , username: "<?php echo getUsername()?>"},
				//上传评论信息至后台
				success: function(data){
					if(data.success==1){
						location.reload();	//刷新
					}
				}
			});
		}
		else{
			cmtContent.focus();	//评论区域为空,重新聚焦textarea
			cmtContent.attr('placeholder','评论不能为空...');
		}
	}
	</script>
</body>
</html>