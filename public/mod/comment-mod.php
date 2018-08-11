<div id="cmtlist">
	<!-- 评论列表 -->
	<div class="container">
		<div class="post-topic">
			<img src="../public/static/images/logo.png" alt="logo">
			<span><script>document.write(document.title);</script></span>
		</div>
<?php
	$page_limit = 5;
	if(isset($_GET['page'])){
		$offset = ($_GET['page']-1)*$page_limit;
	}
	else{
		$offset = 0;
	}
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	include($rootpath.'/machine/admin/connSql.php');
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
						<a href="<?php echo $_SERVER['PHP_SELF']?>?
							pid=<?php echo $_GET['pid']?>&
							page=<?php echo $offset/$page_limit>0?$offset/$page_limit:1?>" aria-label="Previous">
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
						<a href="<?php echo $_SERVER['PHP_SELF']?>?
							pid=<?php echo $_GET['pid']?>&
							page=<?php echo $i+1;?>">
							<?php echo $i+1;?>
						</a>
					</li>
		<?php
			}//endfor
			$pdo = null;//关闭连接
		?>
					<li>
						<a href="<?php echo $_SERVER['PHP_SELF']?>?
							pid=<?php echo $_GET['pid']?>&
							page=<?php echo ($offset/$page_limit+2)<$page_size?($offset/$page_limit+2):$page_size?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
<div id="cmt" class="container">
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
						<img src="/machine/public/images/avatar/<?php echo $_SESSION['avatar']?>" alt="avatar">
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
<script>
var dynamicLoading = {
//通过js动态添加js，css文件
	css: function(path){
		if(!path || path.length === 0){
			throw new Error('argument "path" is required !');
		}
		var head = document.getElementsByTagName('head')[0];
		var link = document.createElement('link');
		link.href = path;
		link.rel = 'stylesheet';
		link.type = 'text/css';
		head.appendChild(link);
	},
	js: function(path){
		if(!path || path.length === 0){
			throw new Error('argument "path" is required !');
		}
		var head = document.getElementsByTagName('head')[0];
		var script = document.createElement('script');
		script.src = path;
		script.type = 'text/javascript';
		head.appendChild(script);
	}
}
//动态加载 CSS 文件
dynamicLoading.css("/machine/public/static/css/comment.css");

//动态加载 JS 文件
// dynamicLoading.js("test.js");


function CmtPost(){
//提交评论
	var cmtContent=$("#cmtContent");  //评论输入文本区
	//alert(cmtContent.val()==null);
	if(cmtContent.val()!==""){
		$.ajax({
			type: "POST",
			url: "../admin/do_comment.php",
			data: {pid: "<?php echo $_GET['pid']?>", 
					content:cmtContent.val() , 
					username: "<?php echo getUsername()?>"},
			//上传评论信息至后台
			success: function(data){
				if(data.success==1){
					location.reload();  //刷新
				}
			}
		});
	}
	else{
		cmtContent.focus(); //评论区域为空,重新聚焦textarea
		cmtContent.attr('placeholder','评论不能为空...');
	}
}
</script>