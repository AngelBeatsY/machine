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
	include('connSql.php');
	if(isset($_GET['name'])){
		$file = $_GET['name'];
	}
	$action = $_GET['action'];
	$flag = 0;
	if($action == 'docDel'){
		//文档删除
		$pid = explode('.', $file)[0];
		$path = "../public/file/";
		if (!unlink($path.$file) ){
			$ret['msg'] = 'error';
		}elseif (!unlink($path."preview_pdf/".$pid.".pdf") ){
			$ret['msg'] = 'pdferror';
		}
		else{
			$sql = "delete from doc where pid='".$pid."'";
			$result = $pdo->prepare($sql);
			$result -> execute(); 
			$ret['msg'] = 'docDel';
		}
		echo ' '.$file.$ret['msg'];
		$flag = 1;
	}elseif ($action == 'videoDel') {
		//视频删除
		$pid = explode('.', $file)[0];
		$path = "../public/video/";
		if (!unlink($path.$file) ){
			$ret['msg'] = 'error';
		}else{
			$sql = "delete from video where pid='".$pid."'";
			$result = $pdo->prepare($sql);
			$result -> execute(); 
			$ret['msg'] = 'videoDel';
		}
		echo ' '.$file.$ret['msg'];
		$flag = 1;
	}elseif ($action == 'postDel') {
		//帖子删除
		$pid = $_GET['pid'];
		$sql = "delete post,comment from post,comment where post.pid='".$pid."' and comment.pid='".$pid."'";
		$result = $pdo->prepare($sql);
		$result -> execute(); 
		$ret['msg'] = 'postDel';
		echo ' '.$pid.$ret['msg'];
		$flag = 1;
	}

	if($action == 'setTopPost'){
		//帖子置顶/取消
		$pid = $_GET['pid'];
		$sql = "update post set isTop=abs(isTop-1) where pid='".$pid."'";
		$result = $pdo->prepare($sql);
		$result -> execute(); 
		$ret['msg'] = 'setTopPost/更改成功';
		echo $pid.' '.$ret['msg'];
		$flag = 1;
		/*header("Refresh:5;url=../public/mod/admin-mod.php");
		exit();*/
	}

	if($action == "changeKeyword"){
		//更改关键字
		include('connSql.php');//包含数据库连接文件
		$newKeyword = htmlspecialchars($_POST['newKeyword']);
		$sort = explode('_', $_POST['fileInfo'])[0]; //文件类别doc/video
		$pid = explode('_', $_POST['fileInfo'])[1];	//文件id
		$sql = "update $sort set keywords='$newKeyword' where pid='$pid'";
		$result = $pdo->query($sql);
		$pdo = null;//关闭连接
		echo "<script type='text/javascript'>document.location.href='../public/mod/admin-mod.php'</script>";
	}

	if($flag == 1){
		//延时跳转
		exit('<br/><span id="second" style="color:#f7931e"></span> 秒后跳转>_<
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