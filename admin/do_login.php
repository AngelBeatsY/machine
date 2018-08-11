<style>
	body{
		padding-top: 150px;
		text-align: center;
		font-size: 18px;
		font-weight: bold;
		color: #666;
		background-color: #ddd;
	}
</style>
<?php
	session_start();
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	$httphost = $_SERVER ['HTTP_HOST'];
	//注销登录
	if(@$_GET['action'] == "logout"){
		// unset($_SESSION['username']);
		session_unset();
		//echo '注销登录成功！点击此处 <a href="http://'.$httphost.'/machine/login.php">登录</a>';
		echo '<script type="text/javascript">history.go(-1);</script>';
		exit;
	}
	//登录
	if(!isset($_POST['submit'])){
		exit('非法访问!');
	}
	@$username = htmlspecialchars($_POST['inputEmail']);
	$username = strtolower($username);	//转换小写
	@$password = MD5($_POST['inputPassword']);  //MD5保存密码安全
	include($rootpath.'/machine/admin/connSql.php');
	$sql = "select * from account where username='$username' and password='$password'";
	$result = $pdo->query($sql);
	$res = $result -> fetchAll();
	$pdo = null;//关闭连接
	if( count($res)==1){
		//登录成功
		$_SESSION['username'] = $username;
		$_SESSION['nickname'] = $res[0]['nickname'];
		$_SESSION['avatar'] = $res[0]['avatar'];
		//echo $username,' 欢迎你！进入 <a href="http://'.$httphost.'/machine/admin/my.php">用户中心</a><br />';
		//echo '点击此处 <a href="do_login.php?action=logout">注销</a> 登录！<br />';
		//header("Location:http://".$httphost."/machine/admin/my.php");
		if($username=="admin"){
			$_SESSION['admin'] = 1;
			$url='/machine/public/mod/admin-mod.php';
			echo '<script type="text/javascript">location.href="'.$url.'";</script>';
		}else{
			echo '<script type="text/javascript">history.go(-2);</script>';
		}
		exit;
	}
	else {
		echo $username, '<br/>';
		//echo $password, '<br/>';
		// exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
		exit('指令错误！<span id="second" style="color:#f7931e"></span> 秒后系统重新启动！！！
			<script type="text/javascript">
			var time = 3;
			function showTime(){
				time-=1;
				document.getElementById("second").innerHTML=time;
				if(time==0){
					history.go(-1);
					//alert("ok");
				}
				else{
					setTimeout("showTime()",1000);
				}
			}
			showTime();
			</script>');
	}
?>