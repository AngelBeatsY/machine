<?php
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	include($rootpath.'/machine/admin/connSql.php');	//连接数据库
	$pid = $_POST["pid"];	//pid:帖子id
	$content = $_POST["content"];	//content:评论内容
	$username = $_POST["username"];	//username:评论用户id
	$sql = "insert into comment (pid,content,username) values ('$pid','$content','$username')";	//插入数据库
	$result = $pdo->prepare($sql);
	$result -> execute();
	$pdo = null;	//关闭连接
	$ret=array();
	$ret['success'] = 1;
	header('content-type:application/json');
	echo json_encode($ret);
?>