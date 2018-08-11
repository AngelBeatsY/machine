<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<title>Forum</title>
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
		.table > tbody > tr >th,.table > tbody > tr >td{
			border-top: 0;
			border-bottom: 1px solid #ddd;
		}
		.th{
			font-size: 16px;
			/*height: 60px;*/
		    font-weight: bold;
		    /*line-height: 60px;*/
		    background: rgba(255,255,255,0.6);
		    /*border-top: 1px solid rgba(255,255,255,0.15);*/
		}
		.th .table{
			text-align: left;
			margin-bottom: 0;
		}
		.th .new{
			padding-right: 30px;
			text-align: right;
		}
		.comm{
			/* min-height: 1080px; */
			margin-bottom: 30px;
			background-color: rgba(255,255,255,0.6);
		}
		.commtable{
			margin-bottom: 0;
			font-size: 16px;
		    font-weight: bold;
		    text-align: left;
		    color: #4C4C4C;
			/*color: #F7F7F7;*/
			table-layout:fixed;
			border-collapse:separate;
		}
		.commtable th{
			overflow: hidden; 
			text-overflow: ellipsis; 
			white-space: nowrap;
		}
		.commtable a:hover{
			text-decoration: none;
		}
		.commtable .new{
			padding-right: 30px;
			text-align: right;
		}
		.commtable .icon{
			text-align: right;
		}
		.commtable .glyphicon{
			/*color: #3A83F1;*/
			/*color: #f7931e;*/
			color: rgba(247,147,30,0.7);
		}
		.paging{
			text-align: center;
			font-size: 15px;
			font-weight: bold;
		}
		#cmt{
			padding-top: 30px;
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
			margin-bottom: 8px;
			padding-left: 15px;
		    font-size: 24px;
			text-align:left;
			font-weight: bold;
			color: rgba(0,0,0,0.5);
		}
		.userInfo{
			margin-top: 15px;
			height: 24px;
			line-height: 24px;
		}
		.cmt-content{
			
		}
		.post-title{
			padding-left: 0;
			margin-bottom:8px;
		}
		.avatar img{
			width: 80px;
			height: 80px;
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
	<?php include '../header.php';//引入导航栏?>
	<div class="jumbotron">
		<div class="container">
			<blockquote><h1>综合讨论区</h1></blockquote>
		</div>
	</div>
	<div class="th container">
		<table class="table">
			<tbody>
				<tr>
					<td class="col-md-1"></td>
					<td class="col-md-5">标题</td>
					<td class="col-md-3">作者</td>
					<td class="col-md-1">回复</td>
					<td class="new col-md-2">最后发表</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="comm container">
		<table class="table table-hover commtable">
			<!-- <thead>
				<tr>
					<th class="col-md-1"></th>
					<th class="col-md-5">标题</th>
					<th class="col-md-2">作者</th>
					<th class="col-md-2">回复</th>
					<th class="col-md-2">最后发表</th>
				</tr>
			</thead> -->	
	<?php
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include($rootpath.'/machine/admin/connSql.php');
		$page_limit = 5;
		if(isset($_GET['page'])){
			$offset = ($_GET['page']-1)*$page_limit;
		}
		else{
			$offset = 0;
		}
		$sql = "select * from post where isTop=1";	//查询置顶帖
		$result = $pdo->query($sql);
		$row = $result->fetchAll();
		for($i=0;$i<count($row);$i++){
			$cmtsql = "select * from comment where pid=".$row[$i]['pid'];	//查询指定pid的文章评论
			$cmtresult = $pdo->query($cmtsql);
			$cmtrow = $cmtresult->fetchAll();
			$cmtNum = count($cmtrow)-1;	//统计评论数量
	?>
			<tbody id="post_<?php echo $row[$i]['pid'];?>">
				<tr>
					<td class="icon col-md-1"><span class="glyphicon glyphicon-lock"></span></td>
					<th class="comment-title col-md-5">
						<a href="/machine/forum/post.php?pid=<?php echo $row[$i]['pid'];?>" style="color: red;">
							<?php echo $row[$i]['topic'];?>
						</a>
					</th>
					<td class="frm col-md-3"><?php echo $row[$i]['username'];?></td>
					<td class="num col-md-1"><span class="glyphicon glyphicon-option-vertical"></span><?php echo $cmtNum;?></td>
					<td class="new col-md-2"><?php echo $row[$i]['time'];?></td>
				</tr>
			</tbody>
	<?php
		}//endfor
		$sql = "select * from post where isTop=0 limit $offset,$page_limit";	//查询帖子
		$result = $pdo->query($sql);
		$row = $result->fetchAll();
		for($i=0;$i<count($row);$i++){
			$cmtsql = "select * from comment where pid=".$row[$i]['pid'];	//查询指定pid的文章评论
			$cmtresult = $pdo->query($cmtsql);
			$cmtrow = $cmtresult->fetchAll();
			$cmtNum = count($cmtrow)-1;	//统计评论数量
	?>
			<tbody id="post_<?php echo $row[$i]['pid'];?>">
				<tr>
					<td class="icon col-md-1"><span class="glyphicon glyphicon-file"></span></td>
					<th class="comment-title col-md-5">
						<a href="/machine/forum/post.php?pid=<?php echo $row[$i]['pid'];?>">
							<?php echo $row[$i]['topic'];?>
						</a>
					</th>
					<td class="frm col-md-3"><?php echo $row[$i]['username'];?></td>
					<td class="num col-md-1"><span class="glyphicon glyphicon-option-vertical"></span><?php echo $cmtNum;?></td>
					<td class="new col-md-2"><?php echo $row[$i]['time'];?></td>
				</tr>
			</tbody>
	<?php 
		}//endfor
		$pdo = null;//关闭连接
	?>
		</table>
		<div class="paging">
			<nav aria-label="Page navigation">
				<ul class="pagination">
					<li>
						<a href="forum.php?page=<?php echo $offset/$page_limit>0?$offset/$page_limit:1?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
			<?php
				$rootpath = $_SERVER['DOCUMENT_ROOT'];
				include($rootpath.'/machine/admin/connSql.php');
				$sql = "select count(*) as count from post";	//查询帖子数量
				$result = $pdo->query($sql);
				$row = $result->fetch();
				$page_size = ceil($row['count']/$page_limit);
				for($i=0;$i<$page_size;$i++){
			?>
					<li><a href="forum.php?page=<?php echo $i+1;?>"><?php echo $i+1;?></a></li>
			<?php
				}//endfor
				$pdo = null;//关闭连接
			?>
					<li>
						<a href="forum.php?page=<?php echo ($offset/$page_limit+2)<$page_size?($offset/$page_limit+2):$page_size?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div id="cmt" class="container post-warpper">
		<table class="table">
			<tbody>
				<tr>
			<?php
				if(isset($_SESSION['username'])){
			?>
					<td class="cmt-info col-md-3">
						<div class="cmt-title">发表帖子...</div>
						<div class="avatar">
							<img src="/machine/public/images/avatar/<?php echo $_SESSION['avatar']?>" alt="avatar">
						</div>
						<div class="userInfo"><?php echo $_SESSION['username'];?></div>
					</td>
					<td class="cmt-content col-md-9">
						<div class="post-title col-md-7">
							<input type="text" class="form-control" id="postTopic" placeholder="主题...">
						</div>
						<div class="pct">
							<textarea class="form-control" rows="5" id="postContent"></textarea>
						</div>
						<p><button type="submit" class="btn submit-btn pull-right" onclick="Post();">发表帖子</button></p>
					</td>
			<?php
				}//endif
				else{
			?>
					<td class="cmt-content col-md-12">
						<p>
							<button class="btn submit-btn pull-right" 
								onclick="javascript:window.location.href='/machine/login.php'">发表帖子
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

	function Post(){
		var postTopic = $('#postTopic');	//帖子主题
		var postContent = $('#postContent');//帖子内容
		if(postTopic.val() !=="" && postContent.val() !==""){
			$.ajax({
				type: "POST",
				url: "../admin/do_post.php",
				data: {topic:postTopic.val() , content:postContent.val() , username: "<?php echo getUsername()?>"},
				success: function(data){
					if(data.success==1){
						location.reload();
					}
				}
			});
		}
		else{
			postTopic.val()==="" ? 
				postTopic.attr('placeholder','主题不能为空...').focus() : 
				postContent.attr('placeholder','内容不能为空...').focus();
		}
	}
	</script>
</body>
</html>