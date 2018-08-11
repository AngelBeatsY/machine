<div class="course">
	<div class="container">
		<div class="row">
			<ul class="list-unstyled">
		<?php 
			$page_limit = 6;
			if(isset($_GET['page'])){
				$offset = ($_GET['page']-1)*$page_limit;
			}
			else{
				$offset = 0;
			}
			$rootpath = $_SERVER['DOCUMENT_ROOT'];
			include($rootpath.'/machine/admin/connSql.php');	//连接数据库
			$sql = "select * from video order by id limit $offset,$page_limit";
			$result = $pdo->query($sql);
			$row = $result->fetchAll();
			for($i=0;$i<count($row);$i++){
		?>
				<li class="col-md-4 col-sm-6 col-xs-12 media-item" title="<?php echo $row[$i]['keywords']?>">
					<div class="media-border">
						<a href="/machine/course/video.php?
							pid=<?php echo $row[$i]['pid'];?>&
							original_name=<?php echo $row[$i]['original_name'];?>&
							cover=<?php echo $row[$i]['cover']?>" class="media-content" style="background: url(/machine/public/images/<?php echo $row[$i]['cover'];?>) no-repeat;background-size:cover;">
							<div class="m-media-wp-span">
								<?php echo $row[$i]['original_name'];?>
								<div class="video-keywords">关键字：<?php echo $row[$i]['keywords']?></div>
							</div>
						</a>
					</div>
				</li>
		<?php 
			}//endfor
		?>
			</ul>
		</div>
	</div>
</div>
<div class="paging">
			<nav aria-label="Page navigation">
				<ul class="pagination">
					<li>
						<a href="<?php echo $_SERVER['PHP_SELF']?>?
							page=<?php echo $offset/$page_limit>0?$offset/$page_limit:1?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
		<?php
			$rootpath = $_SERVER['DOCUMENT_ROOT'];
			include($rootpath.'/machine/admin/connSql.php');
			$sql = "select count(*) as count from video";	//查询指定帖子评论数量
			$result = $pdo->query($sql);
			$row = $result->fetch();
			$page_size = ceil($row['count']/$page_limit);
			for($i=0;$i<$page_size;$i++){
		?>
					<li>
						<a href="<?php echo $_SERVER['PHP_SELF']?>?
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
							page=<?php echo ($offset/$page_limit+2)<$page_size?($offset/$page_limit+2):$page_size?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>