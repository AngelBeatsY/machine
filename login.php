<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/machine/public/static/css/bootstrap.min.css"> 
	<title>登陆</title>
	<style>
		body {
			padding-top: 40px;
			padding-bottom: 40px;
			background: url(/machine/public/static/images/bg-img.jpg) no-repeat fixed left;
			/*background-size: cover;*/
		}
		.form-login{
			max-width: 330px;
			padding: 15px;
			margin: 0 auto;
			color: #ccc;
		}
		.form-login .form-control{
			margin: 50px auto;
		}
		.checkbox{
			margin: -30px 0 20px 5px;
		}
	</style>
</head>
<body>
	<div class="container">
		<form class="form-login" method="post" action="/machine/admin/do_login.php">
	        <h2 class="form-login-heading">登录...</h2>
	        <label for="inputEmail" class="sr-only">邮箱</label>
	        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="邮箱" required autofocus>
	        <label for="inputPassword" class="sr-only">密码</label>
	        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="密码" required>
	        <div class="checkbox">
	          <label>
	            <!-- <input type="checkbox" value="remember-me">记住我 -->
	          </label>
	        </div>
	        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">登录</button>
      </form>
	</div>
	<script src="/machine/public/static/js/jquery-3.1.1.min.js"></script>
	<script src="/machine/public/static/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		
	</script>
</body>
</html>