<?php
	$httphost = $_SERVER ['HTTP_HOST'];
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	include($rootpath.'/machine/admin/connSql.php');
	
	@$username = htmlspecialchars($_POST['inputEmail']);
	@$password = MD5($_POST['inputPassword']);
	$nickname = explode('@',$username)[0];	//默认昵称
	$username = strtolower($username);	//转换字符串为小写
	//@$password = htmlspecialchars($_POST['inputPassword']);
	$sql = "select count(*) as total from account where username='$username'"; //查找是否有重名用户
	$result = $pdo->query($sql);
	$res = $result->fetch();
	@$checkname = $res['total'];
	
	if ($username != null && $password != null && $checkname==0) {
		$sql = "insert into account (username,password,nickname) values ('$username','$password','$nickname')"; //插入数据库
		$result = $pdo->prepare($sql);
		$result -> execute();
		$msg = 1;
	}
	$pdo = null;//关闭连接
	if(@$msg == 1){
		header("Location:http://".$httphost."/machine/login.php");
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/machine/public/static/css/bootstrap.min.css"> 
	<title>注册</title>
	<style type="text/css">
		body {
			padding-top: 40px;
			padding-bottom: 40px;
			background: url(/machine/public/static/images/bg-img.jpg) no-repeat fixed right;
			/*background-size: cover;*/
		}
		.form-register{
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
			/*background-color: #fafcfe;
			border: 1px solid #dfe8f2;*/
			color: #ccc;
		}
		.form-register .form-control{
			margin: 50px auto;
		}
		.checkbox{
			margin: -30px 0 20px 5px;
		}
	</style>
</head>
<body>
	<div class="container">
		<form class="form-register" method="post" action="<?php $_PHP_SELF ?>" onsubmit="return InputCheck(this)">
	        <h2 class="form-register-heading">注册...</h2>
	        <label for="inputEmail" class="sr-only">邮箱</label>
	        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="邮箱" required autofocus>
	        <label for="inputPassword" class="sr-only">密码</label>
	        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="密码" required>
	        <label for="confirmPassword" class="sr-only">确认密码</label>
	        <input type="password" id="confirmPassword" class="form-control" placeholder="确认密码" required>
			<div class="alert alert-warning alert-dismissible hidden" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<strong>密码不一致!</strong>请重新输入...
			</div>
	        <div class="checkbox">
	          <label>
	            <!-- <input type="checkbox" value="remember-me">记住我 -->
	          </label>
	        </div>
	        <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
      </form>
	</div>
	<script src="/machine/public/static/js/jquery-3.1.1.min.js"></script>
	<script src="/machine/public/static/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function InputCheck(RegisterForm){
			if (RegisterForm.inputPassword.value != RegisterForm.confirmPassword.value){
				//$(".alert-warning").removeClass("hidden");
				RegisterForm.inputPassword.value = "";
				RegisterForm.confirmPassword.value = "";
				RegisterForm.inputPassword.placeholder = "密码不一致";
				RegisterForm.confirmPassword.placeholder = "密码不一致";
				RegisterForm.inputPassword.focus();
				return (false);
			}
		}
	</script>
</body>
</html>