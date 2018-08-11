<?php
	$ret = array();
	if($_GET['action']=="sendBarrage"){
		$v_id = $_POST['v_id'];
		$content = $_POST['content'];
		$username = $_POST['username'];
		$color = $_POST['color'];
		$v_time = $_POST['v_time'];
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include($rootpath.'/machine/admin/connSql.php');	//连接数据库
		$sql = "insert into barrage (v_id,content,username,color,v_time) values ('$v_id','$content','$username','$color','$v_time')";
		$result = $pdo->query($sql);
		$pdo = null;
		$ret['msg'] = "ok";
	}

	if($_GET['action']=="showBarrage"){
		$v_id = $_GET['v_id'];
		$rootpath = $_SERVER['DOCUMENT_ROOT'];
		include($rootpath.'/machine/admin/connSql.php');	//连接数据库
		$sql = "select * from barrage where v_id='$v_id' order by v_time";
		$result = $pdo->query($sql);
		$pdo = null;
		$row = $result->fetchAll();
		$ret = $row;
	}
	header('content-type:application/json');
	echo json_encode($ret);			//返回ret数组
?>