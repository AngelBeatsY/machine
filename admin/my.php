<?php
	session_start();
	$httphost = $_SERVER ['HTTP_HOST'];
	if(!isset($_SESSION['username'])){
		//检测是否登录，若没登录则转向登录界面
		header("Location:http://".$httphost."/machine/login.php");
		exit();
	}
	$username = $_SESSION['username'];
	$nickname = $_SESSION['nickname'];
	$avatar = $_SESSION['avatar'];
	/*include('connSql.php');//包含数据库连接文件
	$sql = "select * from account where username='$username' limit 1";
	$user_query = $pdo->query($sql);
	while($row=$user_query->fetch()){
		echo "username:".$row['username'].'<br/>';
		echo "password:".$row['password'].'<br/>';
	}
	$pdo = null;//关闭连接*/

	if(@$_GET['action'] == "changeNickname"){
		//更改昵称
		include('connSql.php');//包含数据库连接文件
		@$newnickname = htmlspecialchars($_POST['nickname']);
		$sql = "update account set nickname='$newnickname' where username='$username'";
		$result = $pdo->query($sql);
		$_SESSION['nickname'] = $newnickname;
		$pdo = null;//关闭连接
		echo "<script type='text/javascript'>document.location.href='my.php'</script>";
	}

	if(@$_GET['action'] == "changeAvatar"){
		//更改头像
		include('connSql.php');//包含数据库连接文件
		$newAvatar = htmlspecialchars($_POST['newAvatar']);
		$sql = "update account set avatar='$newAvatar' where username='$username'";
		$result = $pdo->query($sql);
		$_SESSION['avatar'] = $newAvatar;
		$pdo = null;//关闭连接
		echo "<script type='text/javascript'>document.location.href='my.php'</script>";
	}

	if(@$_GET['action'] == "changePassword"){
		//更改头像
		include('connSql.php');//包含数据库连接文件
		$newPassword = MD5(htmlspecialchars($_POST['newPassword']));
		$sql = "update account set password='$newPassword' where username='$username'";
		$result = $pdo->query($sql);
		$pdo = null;//关闭连接
		session_unset();
		echo "<script type='text/javascript'>document.location.href='../login.php'</script>";
	}
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<title>MY</title>
	<style>
	body{
		font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
		background-color: #eee;
	}
	.jumbotron{
		color: #333;
		background-color: rgba(255,255,255,0.6);
		background: url(../public/static/images/my-info.jpg) no-repeat;
		background-size: cover;
		opacity: 1;
		/*filter: blur(2px);*/
	}
	.avatar{
		display: inline-block;
		width: 80px;
		height: 80px;
		cursor: pointer;
	}
	.avatar-img{
		width: 100%;
		height: 100%;
		transition: all 0.2s;
		background-color: rgba(0,245,245,0.7);
	}
	.info-edit-btn{
		font-size: 24px;
		color: #999;
		cursor: pointer;
	}
	.jumbotron h2{
		color:#666;
	}
	#changeAvatar .avatar{
		margin: 10px 15px;
	}
	#changePassword input[type='text']{
		margin-bottom: 15px;
		margin-top: 15px;
	}
	</style>
</head>
<body>
	<?php include '../header.php';?>
	<div class="jumbotron">
		<div class="container">
			<blockquote>
				<h1>
					<div class="avatar" title="点击更换头像">
						<img src="../public/images/avatar/<?php echo $avatar;?>" alt="avatar" id="avatarImg" 
						class="avatar-img img-rounded" data-toggle="modal" data-target="#changeAvatar">
					</div>
					<span><?php echo $nickname; ?></span>
					<span class="info-edit-btn glyphicon glyphicon-edit" title="更改昵称" 
					data-toggle="modal" data-target="#changeNickname"></span>
				</h1>
				<h2>
					<span><?php echo '>_< : '.$username; ?></span>
					<span class="info-edit-btn glyphicon glyphicon-edit" title="更改密码" 
					data-toggle="modal" data-target="#changePassword"></span>
				</h2>
			</blockquote>
		</div>
	</div>
	<div class="my-post container" style="min-height: 240px;">
		
		<div class="list-group">
			<div class="list-group-item active" title="仅显示最近的5个帖子">
				<h4>我的帖子&hellip;</h4>
			</div>
			<!-- <a href="#" class="list-group-item">
				<h4 class="list-group-item-heading">洛斯里克test</h4>
				<p class="list-group-item-text">洛斯里克薪王</p>
			</a> -->
	<?php
		// $rootpath = $_SERVER['DOCUMENT_ROOT'];
		// include($rootpath.'/machine/admin/connSql.php');
		include('connSql.php');//包含数据库连接文件
		$page_limit = 5;
		if(isset($_GET['page'])){
			$offset = ($_GET['page']-1)*$page_limit;
		}
		else{
			$offset = 0;
		}
		$sql = "select * from post where username='".$username."' limit $offset,$page_limit";	//查询帖子
		$result = $pdo->query($sql);
		$row = $result->fetchAll();
		if(count($row)!=0){
			for($i=0;$i<count($row);$i++){
	?>
				<a href="../forum/post.php?pid=<?php echo $row[$i]['pid'];?>" class="list-group-item">
					<h4 class="list-group-item-heading"><?php echo $row[$i]['topic'];?></h4>
					<p class="list-group-item-text">----<?php echo substr($row[$i]['time'],0,16);?></p>
				</a>
	<?php
			}//endfor
		}//endif
		else{
	?>
			<div class="list-group-item">
				<h4>还没有发表帖子&hellip;</h4>
			</div>
	<?php
		}//endelse
	?>
			<div class="list-group-item active" title="仅显示最近的5条评论">
				<h4>我的评论&hellip;</h4>
			</div>
			<!-- <a href="#" class="list-group-item">
				<h4 class="list-group-item-heading">忽如一夜春风来test</h4>
				<p class="list-group-item-text">主题：美妈无敌</p>
			</a> -->
	<?php 
		$sql = "select * from comment where username='".$username."' limit $offset,$page_limit";	//查询评论
		$result = $pdo->query($sql);
		$row = $result->fetchAll();
		if(count($row)!=0){
			for($i=0;$i<count($row);$i++){
				$sql = "select topic from post where pid=".$row[$i]['pid'].
						" union all select original_name from video where pid=".$row[$i]['pid'].
						" union all select original_name from doc where pid=".$row[$i]['pid'];	//查询评论对应的主题
				$result = $pdo->query($sql);
				$topic = $result->fetch();

				// var_dump($topic);
	?>
				<a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><?php echo $row[$i]['content']?></h4>
					<p class="list-group-item-text">主题：<?php echo $topic[0]?></p>
				</a>
	<?php 
			}//endfor
		}//endif
		else{
	?>
			<div class="list-group-item">
				<h4>还没有发表评论&hellip;</h4>
			</div>
	<?php 
		}//endelse
		$pdo = null;//关闭连接
	?>
		</div>
	</div>
	<div class="my-info container" style="min-height: 240px;">
		我的信息
	</div>
	<div id="changeNickname" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">更改昵称&hellip;</h4>
				</div>
				<div class="modal-body">
					<div>
						<form id="newNicknameForm" action="<?php $_PHP_SELF ?>?action=changeNickname" method="post">
							<input type="text" id="nickname" name="nickname" class="form-control" placeholder="输入新昵称...">
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" onclick="saveNickname();">保存</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="changePassword" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">更改密码&hellip;</h4>
				</div>
				<div class="modal-body">
					<div>
						<form id="newPasswordForm" action="<?php $_PHP_SELF ?>?action=changePassword" method="post">
							<input type="text" id="newPassword" name="newPassword" class="form-control" placeholder="输入新密码...">
							<input type="text" id="newPassword2" name="newPassword2" class="form-control" placeholder="再次输入新密码...">
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" onclick="savePassword();">保存</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="changeAvatar" class="modal fade" tabindex="-1" role="dialog">
		<!-- 更换头像 -->
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">更换头像...</h4>
				</div>
				<div class="modal-body">
					<!-- <p>One fine body&hellip;</p> -->
					<div class="avatar">
						<img src="../public/images/avatar/249761544070.png" alt="249761544070.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544071.png" alt="249761544071.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544085.png" alt="249761544085.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544104.png" alt="249761544104.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544086.png" alt="249761544086.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544088.png" alt="249761544088.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544090.png" alt="249761544090.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544136.png" alt="249761544136.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/249761544091.png" alt="249761544091.png" class="avatar-img img-rounded">
					</div>
					<div class="avatar">
						<img src="../public/images/avatar/avatar-default.png" alt="avatar-default.png" class="avatar-img img-rounded">
					</div>
				</div>
				<div class="modal-footer">
					<form id="newAvatarForm" action="<?php $_PHP_SELF ?>?action=changeAvatar"  method="post">
						<input type="hidden" name="newAvatar" id="newAvatar" value="">
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" onclick="saveAvatar();">保存</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php include '../footer.php';?>
	<script src="../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../public/static/js/bootstrap.min.js"></script>
	<script src="../public/static/js/header.js"></script>
	<script>
		//navbar样式选择
		$("#navbar-collapse li:contains(<?php echo $nickname; ?>)").addClass("active");
		$('#changeAvatar').on('show.bs.modal', function () {
			//激活模态框改变avatarImg
			$("#avatarImg").removeClass("img-rounded").addClass("img-thumbnail");
		});
		$("#changeAvatar").on("hidden.bs.modal", function () {
			//关闭模态框改变avatarImg
			$("#avatarImg").removeClass("img-thumbnail").addClass("img-rounded");
		});
		$("#changeAvatar img").on("click",function() {
			//点击头像改变样式
			$("#changeAvatar img").each(function() {
				if ($(this).hasClass("img-thumbnail")) {
					$(this).removeClass("img-thumbnail").addClass("img-rounded");
				}
			});
			$(this).removeClass("img-rounded").addClass("img-thumbnail");
			$("#avatarImg").attr({ src: $(this).attr("src"), alt: $(this).attr("alt")});	//改变头像src和alt
			$("#newAvatar").attr("value",$(this).attr("alt"));	//改变form隐藏域值
		});
		function InputCheck(NewnicknameForm){
			if (NewnicknameForm.nickname.value == ""){
				NewnicknameForm.nickname.placeholder = "不能为空";
				NewnicknameForm.nickname.focus();
				return (false);
			}
		}
		function saveAvatar() {
			$('#changeAvatar').modal('hide');
			// alert($("#avatarImg").attr("alt"));
			if($("#newAvatar").val() != ""){
				// alert($("#newAvatar").val());
				$("#newAvatarForm").submit();
			}
		}
		function saveNickname() {
			$('#changeNickname').modal('hide');
			if($("#nickname").val() != ""){
				$("#newNicknameForm").submit();
			}
		}
		function savePassword() {
			if($("#newPassword").val() != ""){
				if($("#newPassword").val() == $("#newPassword2").val()){
					$("#newPasswordForm").submit();
				}else if($("#newPassword2").val() == ""){
					$("#newPassword2").focus();
				}
				else{
					$("#newPassword").val("");
					$("#newPassword2").val("");
					$("#newPassword").attr("placeholder","密码不一致").focus();
				}
			}else{
				$('#changePassword').modal('hide');
			}
		}
	</script>
</body>
</html>