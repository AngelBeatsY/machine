<?php 
	if(!isset($_SESSION)){
		session_start();//开启session
	}

	function getUsername(){
		if (isset($_SESSION['username'])) {
			return $_SESSION['username'];
		}else{
			return "";
		}
	}
?>
<nav class="navbar navbar-default navbar-fixed-top" marginTOP="0">
	<div class="container">
		<div class="navbar-header">
			<a href="/machine/index.php" class="navbar-brand logo"></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">切换导航</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button> 
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li>
					<a href="/machine/index.php">
						<span class="glyphicon glyphicon-home"></span> 机械云课堂
					</a>
				</li>
				<li>
					<a href="/machine/doc/doc.php">
						<span class="glyphicon glyphicon-folder-close"></span> 文档
					</a>
				</li>
				<li>
					<a href="/machine/course/course.php">
						<span class="glyphicon glyphicon-book"></span> 课程
					</a>
				</li>
				<li>
					<a href="/machine/forum/forum.php">
						<span class="glyphicon glyphicon-comment"></span> 论坛
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<form class="form-inline navbar-form" action="/machine/public/mod/search-mod.php" method="get" onSubmit="return navCheck();">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" id="nav-searchWords" name="searchWords" placeholder="资源搜索">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-default">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</div>
					</form>
				</li>
		<?php 
			if(!isset($_SESSION['username'])){
		?>
				<li>
					<a href="/machine/login.php">登陆</a>
				</li>
				<li>
					<a href="/machine/register.php">注册</a>
				</li>
		<?php
			}//endif
			else{
		?>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<div class="navbar-avatar">
							<img src="/machine/public/images/avatar/<?php echo $_SESSION['avatar'];?>" alt="头像" 
							class="navbar-avatar-img">
						</div>
						<span><?php echo $_SESSION['nickname'];?></span><span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="/machine/admin/my.php">
								<span class="glyphicon glyphicon-user"></span> 我的主页
							</a>
						</li>
						<li>
							<a href="/machine/public/mod/upload-mod.php">
								<span class="glyphicon glyphicon-upload"></span> 文件上传
							</a>
						</li>
				<?php 
					if(isset($_SESSION['admin'])){
				?>
						<li>
							<a href="/machine/public/mod/admin-mod.php">
								<span class="glyphicon glyphicon-cog"></span> 进入管理
							</a>
						</li>
				<?php
					}//endif
				?>
						<li role="separator" class="divider"></li>
						<li>
							<a href="/machine/admin/do_login.php?action=logout"><span class="glyphicon glyphicon-off"></span> 退出</a>
						</li>
					</ul>
				</li>

		<?php
			}//endelse
		?>
			</ul>
		</div>
		
	</div>
</nav>
<div class="div-invisible" id="div-invisible"></div>
<a href="#" class="m-back" id="g_backtop" title="回到顶部">回到顶部</a>