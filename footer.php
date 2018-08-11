<div id="footer">
	<div class="container">
		<p>关于我们- 客户服务- 服务条款- 网站导航- 
	<?php 
		if(isset($_SESSION['username']) && isset($_SESSION['admin'])){
	?>
			<a href="/machine/public/mod/admin-mod.php">进入管理页面</a>
	<?php
		}//endif
		else{
	?>
			<a href="#" data-toggle="modal" data-target="#administratorLogin">管理员登陆</a>
	<?php
		}//endelse
	?>
		</p>
		<p>陕西科技大学版权所有©1997-2017</p>
	</div>
</div>
<div id="administratorLogin" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">舰长登录&hellip;</h4>
			</div>
			<div class="modal-body">
				<div>
					<form id="adminLoginForm" method="post" action="/machine/admin/do_login.php" onsubmit="return adminLogin();">
						<input type="text" id="inputEmail" name="inputEmail" class="form-control admin-input" placeholder="输入用户名...">
						<input type="password" id="inputPassword" name="inputPassword" class="form-control admin-input" placeholder="输入密码...">
						<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">登录</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<!-- <button type="button" class="btn btn-primary" onclick="adminLogin();">登陆</button> -->
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->