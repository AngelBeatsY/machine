<?php
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	include($rootpath.'/machine/admin/connSql.php');//连接数据库
	$pid = date("Ymdis");	//帖子id
	$topic = $_POST["topic"];	//topic:帖子主题
	$content = $_POST["content"];	//content:评论内容
	$username = $_POST["username"];	//username:评论用户id
	$sql = "insert into post (pid,topic,username) values ('$pid','$topic','$username')";	//主题插入数据库
	$result = $pdo->prepare($sql);
	$result -> execute();
	$sql = "insert into comment (pid,content,username) values ('$pid','$content','$username')";	//评论插入数据库
	$result = $pdo->prepare($sql);
	$result -> execute();
	$pdo = null;	//关闭连接
	$ret=array();
	$ret['success'] = 1;
	header('content-type:application/json');
	echo json_encode($ret);			//返回ret数组
?>