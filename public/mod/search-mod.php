<?php
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
	<title>Search</title>
	<style>
	body{
		background: #eee;
	}
	.search-input{
		margin-top: 50px;
		margin-bottom: 50px;
	}
	.search-form{
		width: 560px;
	}
	.tab-content{
		margin-top:25px;
		min-height:720px;
	}
	.row{
		margin: -1px 0;
	}
	.list-group .title{
		color: rgba(0,0,0,0.5);
		font-size: 18px;
		font-weight: bold;
	}
	#post a h4{
		color:#337ab7;
		font-size:16px;
		font-weight:bold;
	}
	.list-group-item-heading{
		display:inline-block;
	}
	.list-group-item-text{
		
		display:inline-block;text-align:right;
	}
	</style>
</head>
<body>
	<?php include '../../header.php';?>
	<div class="container">
		<div class="search-input">
			<form class="search-form center-block" action="<?php $_PHP_SELF ?>" method="get" onSubmit="return check();">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="searchWords" name="searchWords" placeholder="资源搜索" value="<?php echo $searchWords?>">
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
				<!-- <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li> -->
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
								<span class="glyphicon glyphicon-download-alt"></span>
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
										<span class="col-md-6"><?php echo $row[$i]['keywords']?></span>
										<span class="col-md-2"><?php echo substr($row[$i]['time'], 0,10)?></span>
									</div>
									<a class="col-md-2" href="/machine/admin/do_download.php?
										name=<?php echo $row[$i]['pid'].$row[$i]['extension_name']?>&
										original_name=<?php echo $row[$i]['original_name'].$row[$i]['extension_name']?>" class="col-md-2">
										<span class="glyphicon glyphicon-download-alt"> 下 载</span>
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
					}
					$pdo = null;//关闭连接
				?>
					</div>
				</div><!-- doc -->
				<div role="tabpanel" class="tab-pane" id="course">
					<div class="course">
						<div class="row">
							<ul class="list-unstyled">
						<?php 
							$page_limit = 10;
							if(isset($_GET['page'])){
								$offset = ($_GET['page']-1)*$page_limit;
							}
							else{
								$offset = 0;
							}
							$rootpath = $_SERVER['DOCUMENT_ROOT'];
							include($rootpath.'/machine/admin/connSql.php');	//连接数据库
							if($searchWords != ""){
								$sql = "select * from video where original_name like '%".$searchWords."%' or keywords like '%".$searchWords."%' order by id limit $offset,$page_limit";
								$result = $pdo->query($sql);
								$row = $result->fetchAll();
								if(count($row)!=0){
									for($i=0;$i<count($row);$i++){
						?>
										<li class="col-md-4 col-sm-6 col-xs-12 media-item" title="<?php echo $row[$i]['keywords']?>">
											<div class="media-border">
												<a href="/machine/course/video.php?
													pid=<?php echo $row[$i]['pid'];?>&
													original_name=<?php echo $row[$i]['original_name'];?>&
													cover=<?php echo $row[$i]['cover']?>" class="media-content" style="background: url(/machine/public/images/<?php echo $row[$i]['cover'];?>) no-repeat;background-size:cover;">
													<div class="m-media-wp-span">
														<?php echo $row[$i]['original_name'];?>
														<div class="video-keywords">关键字：<?php echo $row[$i]['keywords']?></div>
													</div>
												</a>
											</div>
										</li>
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
							}
							$pdo = null;//关闭连接
						?>
							</ul>
						</div>
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
						$result = $pdo->query($sql);
						$row = $result->fetchAll();
						if(count($row)!=0){
							for($i=0;$i<count($row);$i++){
				?>
								<a href="../../forum/post.php?pid=<?php echo $row[$i]['pid'];?>" class="list-group-item">
									<h4 class="list-group-item-heading"><?php echo $row[$i]['topic'];?></h4>
									<p class="list-group-item-text pull-right">----<?php echo substr($row[$i]['time'],0,16);?></p>
								</a>
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
					}
					$pdo = null;//关闭连接
				?>
					</div>
				</div><!-- post -->
				<!-- <div role="tabpanel" class="tab-pane" id="settings">...</div> -->
			</div>
		</div>
	</div>
	<?php include '../../footer.php';?>
	<script src="../../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../../public/static/js/bootstrap.min.js"></script>
	<script src="../../public/static/js/header.js"></script>
	<script type="text/javascript">
	function check(){
		if($("#searchWords").val()==""){
			$("#searchWords").focus();
			$("#searchWords").attr("placeholder","怕是什么都没有输入哦~");
			return false;
		}else{
			return true;
		}
	}
	$(".m-media-wp-span").on({
			mouseover:function(){$(this).children(".video-keywords").css("display","block");},
			mouseout:function(){$(".video-keywords").css("display","none");}
		});
	</script>
</body>
</html>