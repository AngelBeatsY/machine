<?php
	session_start();
	$httphost = $_SERVER ['HTTP_HOST'];
	//检测是否登录和用户权限，不符合进入条件转入首页
	if(!isset($_SESSION['username']) || !isset($_SESSION['admin'])){
		header("Location:http://".$httphost."/machine/index.php");
		exit();
	}
	if(isset($_GET['searchWords'])){
		$searchWords = $_GET['searchWords'];
	}else{
		$searchWords = "";
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../../public/static/css/header.css"> 
	<link rel="stylesheet" href="../../public/static/css/course.css"> 
	<title>Admin</title>
	<style>
	body{
		background: url(../static/images/bg-img-comm.jpg) no-repeat fixed left;
		background-size: cover;
	}
	.jumbotron{
		color: #FFF;
		background-color: rgba(255,255,255,0.4);
	}
	.search-list{
		margin-bottom: 50px;
		background: rgba(255,255,255,0.6);
	}
	.search-input{
		margin-top: 50px;
		margin-bottom: 50px;
	}
	.search-form{
		width: 560px;
	}
	.nav-tabs{
		/*background: #ccc;*/
	}
	.tab-content{
		margin-top:25px;
		min-height:720px;
		
	}
	.list-group{
		text-align:center;
	}
	.list-group .title{
		color: rgba(0,0,0,0.5);
		font-size: 18px;
		font-weight: bold;
	}
	.row{
		margin: -1px 0;
	}
	.info-edit-btn{
		font-size: 12px;
		color: #999;
		cursor: pointer;
	}
	.glyphicon-remove{
		color: red;
	}
	#post a h4{
		color:#337ab7;
		font-size:16px;
		font-weight:bold;
	}
	/* .list-group-item-heading{
		display:inline-block;
	}
	.list-group-item-text{
		
		display:inline-block;text-align:right;
	} */
	</style>
</head>
<body>
	<?php include '../../header.php';?>
	<div class="jumbotron">
		<div class="container">
			<blockquote><h1>&nbsp;管&nbsp;理</h1></blockquote>
		</div>
	</div>
	<div class="search-list container">
		<div class="search-input">
			<form class="search-form center-block" action="<?php $_PHP_SELF ?>" method="get">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="searchWords" name="searchWords" placeholder="资源搜索(空输入_查所有)" value="<?php echo $searchWords?>">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</div>
			</form>
		</div>
		<div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-justified" role="tablist">
				<li role="presentation" class="active"><a href="#doc" aria-controls="doc" role="tab" data-toggle="tab">文档</a></li>
				<li role="presentation"><a href="#course" aria-controls="course" role="tab" data-toggle="tab">课程</a></li>
				<li role="presentation"><a href="#post" aria-controls="post" role="tab" data-toggle="tab">帖子</a></li>
				<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="doc">
					<div class="list-group">
				<?php 
					$rootpath = $_SERVER['DOCUMENT_ROOT'];
					include($rootpath.'/machine/admin/connSql.php');
					if($searchWords != ""){
						$sql = "select * from doc where original_name like '%".$searchWords."%' or keywords like '%".$searchWords."%'";	//查询文档
					}else{
						$sql = "select * from doc";	//查询文档
					}
					$result = $pdo->query($sql);
					$row = $result->fetchAll();
					if(count($row)!=0){
				?>
						<div class="title list-group-item row">
							<div class="col-md-10">
								<span class="col-md-4">文档</span>
								<span class="col-md-6">关键字</span>
								<span class="col-md-2">上传时间</span>
							</div>
							<div class="col-md-2">
								<span class="glyphicon glyphicon-trash"></span>
							</div>
						</div>
				<?php
						for($i=0;$i<count($row);$i++){
				?>
							<div class="list-group-item row">
								<div class="col-md-10">
									<a href="../../doc/doc-preview.php?flag=true&
										pid=<?php echo $row[$i]['pid'];?>&
										original_name=<?php echo $row[$i]['original_name']?>" class="col-md-4">
										<?php echo $row[$i]['original_name']?>
									</a>
									<span class="col-md-6">
										<?php echo $row[$i]['keywords']?>
										<span class="info-edit-btn glyphicon glyphicon-edit" title="更改关键字" 
											data-toggle="modal" data-target="#changeKeyword" 
											onclick="setHiddenVal('doc_<?php echo $row[$i]['pid'];?>');">
										</span>
									</span>
									<span class="col-md-2"><?php echo substr($row[$i]['time'], 0,10)?></span>
								</div>
								<a class="col-md-2" href="/machine/admin/do_admin.php?action=docDel&
									name=<?php echo $row[$i]['pid'].$row[$i]['extension_name']?>" title="删除">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
							</div>
				<?php
						}//endfor
					}//endif
					else{
				?>
						<div class="list-group-item active">
							<h4>什么都没有搜到...&hellip;</h4>
						</div>
				<?php
					}//endelse
					$pdo = null;//关闭连接
				?>
					</div>
				</div><!-- doc -->
				<div role="tabpanel" class="tab-pane" id="course">
					<div class="list-group">
				<?php 
					$rootpath = $_SERVER['DOCUMENT_ROOT'];
					include($rootpath.'/machine/admin/connSql.php');
					if($searchWords != ""){
						$sql = "select * from video where original_name like '%".$searchWords."%' or keywords like '%".$searchWords."%' order by id";
					}else{
						$sql = "select * from video";
					}
					$result = $pdo->query($sql);
					$row = $result->fetchAll();
					if(count($row)!=0){
				?>
						<div class="title list-group-item row">
							<div class="col-md-10">
								<span class="col-md-4">视频</span>
								<span class="col-md-6">关键字</span>
								<span class="col-md-2">上传时间</span>
							</div>
							<div class="col-md-2">
								<span class="glyphicon glyphicon-trash"></span>
							</div>
						</div>
				<?php
						for($i=0;$i<count($row);$i++){
				?>
							<div class="list-group-item row">
								<div class="col-md-10">
									<a href="../../course/video.php?
										pid=<?php echo $row[$i]['pid'];?>&
										original_name=<?php echo $row[$i]['original_name']?>&
										cover=<?php echo $row[$i]['cover']?>" class="col-md-4">
										<?php echo $row[$i]['original_name']?>
									</a>
									<span class="col-md-6">
										<?php echo $row[$i]['keywords']?>
										<span class="info-edit-btn glyphicon glyphicon-edit" title="更改关键字" 
											data-toggle="modal" data-target="#changeKeyword" 
											onclick="setHiddenVal('video_<?php echo $row[$i]['pid'];?>');">
										</span>
									</span>
									<span class="col-md-2"><?php echo substr($row[$i]['time'], 0,10)?></span>
								</div>
								<a class="col-md-2" href="/machine/admin/do_admin.php?action=videoDel&
									name=<?php echo $row[$i]['pid'].$row[$i]['extension_name']?>" title="删除">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
							</div>
				<?php
						}//endfor
					}//endif
					else{
				?>
						<div class="list-group-item active">
							<h4>什么都没有搜到...&hellip;</h4>
						</div>
				<?php
					}//endelse
					$pdo = null;//关闭连接
				?>
					</div>
				</div><!-- course -->
				<div role="tabpanel" class="tab-pane" id="post">
					<div class="list-group" title="显示10条">
				<?php
					$rootpath = $_SERVER['DOCUMENT_ROOT'];
					include($rootpath.'/machine/admin/connSql.php');//包含数据库连接文件
					$page_limit = 10;
					if(isset($_GET['page'])){
						$offset = ($_GET['page']-1)*$page_limit;
					}
					else{
						$offset = 0;
					}
					if($searchWords != ""){
						$sql = "select * from post where topic like '%".$searchWords."%' limit $offset,$page_limit";	//查询帖子
					}else{
						$sql = "select * from post limit $offset,$page_limit";	//查询帖子
					}
					$result = $pdo->query($sql);
					$row = $result->fetchAll();
					if(count($row)!=0){
				?>
						<div class="title list-group-item row">
							<div class="col-md-10">
								<span class="col-md-4">主题</span>
								<span class="col-md-6">作者</span>
								<span class="col-md-2">时间</span>
							</div>
							<div class="col-md-2">
								<span class="glyphicon glyphicon-cog"></span>
							</div>
						</div>
				<?php
						for($i=0;$i<count($row);$i++){
				?>
							<!-- <a href="../../forum/post.php?pid=<?php echo $row[$i]['pid'];?>" class="list-group-item">
								<h4 class="list-group-item-heading"><?php echo $row[$i]['topic'];?></h4>
								<p class="list-group-item-text pull-right">-<?php echo substr($row[$i]['time'],0,16);?></p>
							</a> -->
							<div class="list-group-item row">
								<div class="col-md-10">
									<a href="../../forum/post.php?pid=<?php echo $row[$i]['pid'];?>" 
									class="col-md-4">
										<?php echo $row[$i]['topic'];?>
									</a>
									<span class="col-md-6"><?php echo $row[$i]['username']?></span>
									<span class="col-md-2"><?php echo substr($row[$i]['time'], 0,10)?></span>
								</div>
								<a class="col-md-1" href="/machine/admin/do_admin.php?action=postDel&
									pid=<?php echo $row[$i]['pid']?>" title="删除">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
				
				<?php
						if($row[$i]['isTop'] ==0 ){
				?>
								<a class="col-md-1" href="/machine/admin/do_admin.php?action=setTopPost&
									pid=<?php echo $row[$i]['pid']?>" title="设为置顶">
									<span class="glyphicon glyphicon-chevron-up"></span>
								</a>
				<?php
						}else{
				?>
								<a class="col-md-1" href="/machine/admin/do_admin.php?action=setTopPost&
									pid=<?php echo $row[$i]['pid']?>" title="取消置顶">
									<span class="glyphicon glyphicon-chevron-down"></span>
								</a>
				<?php
						}//endif
				?>
							</div>
				<?php
						}//endfor
					}//endif
					else{
				?>
						<div class="list-group-item active">
							<h4>什么都没有搜到...&hellip;</h4>
						</div>
				<?php
					}//endelse
					$pdo = null;//关闭连接
				?>
					</div>
				</div><!-- post -->
				<div role="tabpanel" class="tab-pane" id="settings">施工中...</div>
			</div>
		</div>
	</div>
	<div id="changeKeyword" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">更改关键字&hellip;</h4>
				</div>
				<div class="modal-body">
					<div>
						<form id="newKeywordForm" action="../../admin/do_admin.php?action=changeKeyword" method="post">
							<input type="text" id="newKeyword" name="newKeyword" class="form-control" placeholder="输入关键字...">
							<input type="hidden" id="hiddenVal" name="fileInfo" value="value">
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" onclick="saveKeyword();">保存</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php include '../../footer.php';?>
	<script src="../../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../../public/static/js/bootstrap.min.js"></script>
	<script src="../../public/static/js/header.js"></script>
	<script type="text/javascript">
	$(".m-media-wp-span").on({
		mouseover:function(){$(this).children(".video-keywords").css("display","block");},
		mouseout:function(){$(".video-keywords").css("display","none");}
	});
	function setHiddenVal(pid){
		$("#hiddenVal").val(pid);
	}
	function saveKeyword() {
		$('#changeKeyword').modal('hide');
		if($("#newKeyword").val() != ""){
			$("#newKeywordForm").submit();
		}
	}
	</script>
</body>
</html>