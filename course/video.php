<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="../public/static/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../public/static/css/header.css"> 
	<title><?php echo $_GET['original_name'];?></title>
	<style>
		body { 
			font-family: "Helvetica Neue", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif; 
			background-color: #eee;
		}
		.video-player{
			margin-top: 50px;
			margin-bottom: 50px;
			max-width: 960px;
			min-width: 360px;
			/*background-color: #ccc;*/
		}
		.video-player .btn{
			/*border-radius: 0;*/
		}
		.video{
			position: relative;
			padding: 0 0px;
			/*margin-bottom: -5px;*/
			background: #000;
		}
		#video{
			width: 100%;
		    height: 100%;
		    background:transparent url('../public/images/<?php echo $_GET['cover']?>') 50% 50% no-repeat;
		    -webkit-background-size:cover;
		    -moz-background-size:cover;
		    -o-background-size:cover;
		    background-size:cover;
		}
		.video:before{
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			cursor: pointer;
			transition: all 0.5s;
			background: url("images/youtube-btn-ylw.png") no-repeat;
			background-position: center center;
			background-size: 100px 100px;
		}
		.video.other:before{
			/*display: none;*/
			opacity: 0;
		}
		.video:hover:before{
			background-image: url(/machine/course/images/youtube-btn-wh.png);
		}
		/*.screen{
			position:absolute;top:0;right:0;
			width: 100%;
			height: 100%;
			color: #ccc;
			z-index: 999;
		}*/
		.video div{
			/*弹幕*/
			position:absolute;
			font-size: 18px;
			font-weight: bold;
			z-index: 999;
		}
		.control-bar{
			width: 100%;
		}
		.barrage{
			width: 100%;
		}
		input[type="color"]{
			width: 100%;
			height: 26px;
			background-color: #ccc;
			border-radius: 0px;
			border: 0;
		}
		
		#progressWrap{
			/*background-color: black;*/
			cursor: pointer;
			padding: 0px 0px;
		}
		#playProgress{
			background-color: rgb(48, 204, 255);
			width: 0px;
			height: 100%;
			line-height: 32px;
			text-align: right;
			border-right: 2px solid rgb(0, 166, 216);
		}
		#showProgress{
			background-color: ;
			font-weight: bold;
			font-size: 14px;
			line-height: 100%;
		}

:-webkit-full-screen video {
width: 100%;
height: 100%;
padding: 0 15px;
margin-bottom: -5px;
}
:-moz-full-screen video{
width: 100%;
height: 100%;
padding: 0 15px;
margin-bottom: -5px;
}
	</style>
</head>
<body>
	<?php include '../header.php';?>
	<div class="video-player container" id="videoPlayer">
		<!-- 视频播放器 -->
		<div class="video">
			<video id="video" width="100%" height="100%" poster="../public/images/transparent.png" >
				<source src="../public/video/<?php echo $_GET['pid'];?>.mp4" type="video/mp4">
				<source src="../public/video/<?php echo $_GET['pid'];?>.ogg" type="video/ogg">
				<source src="../public/video/<?php echo $_GET['pid'];?>.WebM" type="video/WebM">
				您的浏览器不支持Video标签。
			</video>
			<!-- <div class="screen">
			</div> -->
		</div>
		<div class="control-bar">
			<div class="input-group">
				<span class="input-group-btn">
				<!-- 播放/暂停 -->
					<a class="btn btn-default btnPlay" title="播放/暂停"><span class="glyphicon glyphicon-play"></span></a>
				</span>
				<div class="form-control" id="progressWrap">
				<!-- 进度条 -->
					 <div id="playProgress"> 
                        <span id="showProgress">0</span> 
                    </div>
				</div>
				<span class="input-group-addon" id="sizing-addon">
				<!-- 播放进度 -->
					<div class="progressTime">
						<span class="current">0:0</span>/
						<span class="duration">0:0</span>
					</div>
				</span>
				<span class="input-group-btn">
				<!-- 全屏 -->
					<a class="btn btn-default fullscreen" title="全屏"><span class="glyphicon glyphicon-fullscreen"></span></a>
				</span>
			</div>
		</div>
		<div class="barrage">
			<!--Send Begin-->
			<div class=" send">
				<div class="input-group">
					<div class="input-group-btn dropup">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="弹幕颜色">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="javascript:void(0)" style="background: #FFF;">#FFFFFF</a></li>
							<li><a href="javascript:void(0)" style="background: #0C72C3;">#0C72C3</a></li>
							<li><a href="javascript:void(0)" style="background: #C20C0C;">#C20C0C</a></li>
							<li><a href="javascript:void(0)" style="background: #FFCC00;">#FFCC00</a></li>
							<li><a href="javascript:void(0)" style="background: #FFCCCC;">#FFCCCC</a></li>
							<li><a href="javascript:void(0)" style="background: #FF9966;">#FF9966</a></li>
							<li><input type="color" class="btn btn-default" id="setColor" value="#FFFFFF"></li>
							<li role="separator" class="divider"></li>
    						<li>
	    						<div class="input-group" id="user_defined">
		    						<span class="input-group-addon" id="basic-addon1">#</span>
									<input type="text" class="form-control" placeholder="颜色...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">
											<span class="glyphicon glyphicon-menu-right"></span>
										</button>
									</span>
							    </div><!-- /input-group -->
						    </li>
						</ul>
					</div><!-- /btn-group -->
			<?php
				if(isset($_SESSION['username'])){
			?>
					<input type="text" class="form-control s_text" placeholder="您可以在这里输入弹幕吐槽哦~">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default s_close" title="关闭弹幕">关</button>
						<button type="button" class="s_btn btn btn-default">发送 ></button>
					</span>
			<?php
				}//endif
				else{
			?>
					<input type="text" class="form-control s_text" placeholder="登陆后才能发送弹幕吐槽哦~" disabled="disabled">
					<span class="input-group-btn">
						<a href="../login.php" class="btn btn-default" role="button">登陆</a>
						<a href="../register.php"  class="btn btn-default" role="button">注册</a>
					</span>
			<?php
				}//endelse
			?>
				</div><!-- /input-group -->
			</div><!--Send End-->
		</div>
	</div>
	<div class="uploadfile" style="position:absolute;top:200px;right:45px">
		<!-- 上传按钮 -->
		<a href="../public/mod/upload-mod.php" class="btn btn-default">上传</a>
	</div>
	<div id="comment-mod" class="">
		<!-- 评论模块 -->
		<?php include '../public/mod/comment-mod.php';?>
	</div>
	<!-- <button id="testbtn">testbtn</button> -->
	<?php include '../footer.php';?>
	<script src="../public/static/js/jquery-3.1.1.min.js"></script>
	<script src="../public/static/js/bootstrap.min.js"></script>
	<script src="../public/static/js/header.js"></script>
	<script>
		//navbar样式选择
		$("#navbar-collapse li:contains(课程)").addClass("active");
		//发送弹幕
		$('.send .s_btn').click(function(){
			var text = $('.s_text').val();
			if (text == "") {
				$('.barrage .s_text').focus().attr('placeholder','您还什么都没有输入哦~');
				return;
			}else{
				$.post("../admin/do_barrage.php?action=sendBarrage", 
					{	"v_id": "<?php echo $_GET['pid']?>",
						"content":text,
						"username":"<?php echo getUsername()?>",
						"color": $(".barrage .dropdown-toggle").css("background-color"),
						"v_time": Math.floor($("#video")[0].currentTime)},
				function(data){
					console.log(data);
					console.log(data.msg);
					var _lable = $("<div  style='opacity:1;color:"+setColor()+";'>"+text+"</div>");
					$('.video').append(_lable.show());
					init_barrage();

					$('.s_text').val("");
				}, "json");
			}
		});
		//初始化弹幕
		function init_barrage(){
			$('.video div').show().each(function(){
				$(this).css({'right':'20px','left':'','top':'20px'});
				$(this).animate({left:'20px'},3000,function(){
					$(this).remove();
				});
			});
		}
		function setColor(){
			return $('#setColor').val();
		}
		//颜色选择
		$(function () { 
			$(".s_close").on("click",function(){
				alert($(".barrage .dropdown-toggle").css("background-color"));
			})
	        $('.barrage ul a').each(function () {  
	            $(this).click(function() {
	                $('.barrage .dropdown-toggle').css('background',$(this).text());
	                $('#setColor').val($(this).text());
	            });  
	        });  
	        $("#setColor").on("change",function(){
				$('.barrage .dropdown-toggle').css('background',$(this).val());
			})
	        $('#user_defined button').click(function(){
	        	var text = $('#user_defined input[type="text"]');
	        	if (text.val()==="") {
	        		$('.barrage .s_text').attr('placeholder','颜色输入错误...');
	        	}
	        	else{
	        		$('.barrage .dropdown-toggle').css('background',"#"+text.val());
	        		$('#setColor').val("#"+text.val());
	        	}
	        });
	    }); 
	    //按时间节点播放弹幕 
		$(function(){
			i=0;	//全局变量,弹幕列表选择
			barrages = 0;
			var video = $('#video');	//$('#video')[0] == document.getElementById("video");
			$.get("../admin/do_barrage.php?action=showBarrage&v_id=<?php echo $_GET['pid']?>", function(data){
				//从服务器加载数据
				if(data[0] != null){
				//弹幕列表为空时barrages重新赋值,防止barrages[i]未定义警告
					barrages = data;
				}else{
					barrages = [0];
				}
			});
			
			video.on('timeupdate', function() {
				var time = video[0].currentTime;
				if(Math.floor(time) == barrages[i]['v_time']){
					var _lable = $("<div style='opacity:1;color:"+
						barrages[i]['color']+";'>"+
						barrages[i]['content']+"</div>");
					$('.video').append(_lable.show());
					init_barrage();
					if((i+1)<barrages.length){
						i++;
					}else{
						i=0;
					}
				}
			});
		});


		//播放控件
		$(function(){
			var video = $('#video');
			//Play/Pause control clicked
			$('.btnPlay,#video,.video').on('click', function() {
				if(video[0].paused) {
					video[0].play();
					$(".btnPlay span").removeClass("glyphicon-play");
					$(".btnPlay span").addClass("glyphicon-pause");
					$(".video").addClass("other");
					progressFlag = setInterval(getProgress,60);
				}
				else {
					video[0].pause();
					$(".btnPlay span").removeClass("glyphicon-pause");
					$(".btnPlay span").addClass("glyphicon-play");
					$(".video").removeClass("other");
					 clearInterval(progressFlag);
				}
				return false;
			});
			//get HTML5 video time duration
			// myVid=document.getElementById("video");
			// myVid.onloadedmetadata=$('.duration').text(intTime(video[0].duration));
			
			//get HTML5 video time duration
			video.on('loadedmetadata', $('.duration').text(intTime(video[0].duration)));
			//update HTML5 video current play time
			video.on('timeupdate', function() {
				$('.current').text(intTime(video[0].currentTime));
			});
			//全屏显示
			var flag=1;
			$('.fullscreen').on('click', function() {
				//For Webkit
				// video[0].webkitEnterFullscreen();
				
				//For Firefox
				//video[0].mozRequestFullScreen();
				/*$('.video-player')[0].mozRequestFullScreen();
				return false;*/
				
				if(flag==1){
					fullScreen(document.getElementById("videoPlayer"));
					flag=0;
				}else{
					exitFullscreen(document.getElementById("videoPlayer"));
					flag=1;
				}

				/*$('.video-player').width($(window).width());
				$('.video-player').height($(window).height());
				$('.video').width($(window).width());
				$('.video').height($(window).height());*/
			});

			var progressWrap = document.getElementById("progressWrap");
            var playProgress = document.getElementById("playProgress");
			// video的播放条
            function getProgress(){
               var percent = video[0].currentTime / video[0].duration;
               playProgress.style.width = percent * (progressWrap.offsetWidth) - 2 + "px";
               showProgress.innerHTML = (percent * 100).toFixed(1) + "%";
            }
		});
		function fullScreen(element) { 
			if(element.requestFullScreen) { 
				element.requestFullScreen(); 
			} else if(element.webkitRequestFullScreen ) { 
				element.webkitRequestFullScreen(); 
			} else if(element.mozRequestFullScreen) { 
				element.mozRequestFullScreen(); 
			} 
		} 
		function exitFullscreen(element) {
			if (element.exitFullscreen) {
				element.exitFullscreen();
			} else if (element.mozCancelFullScreen) {
				element.mozCancelFullScreen();
			} else if (element.webkitCancelFullScreen) {
				element.webkitCancelFullScreen();
			}
		}
		//数字转为时间形式  00:00:00;
		function intTime(num) {
			var hour = Math.floor (num / 3600);
			var other = num % 3600;
			var minute = Math.floor (other / 60);
			var second = (other % 60).toFixed (0);
			hour = (hour==0?"":hour+":");
			minute = (minute==0?"":minute+":");
			return hour+minute+second;
		}

		//进度条选择
		$('#progressWrap').mousedown(function(e){ 
			$("#showProgress").text("X:" + e.pageX + 
				"Y:" + e.pageY + 
				"off"+ getElementLeft(progressWrap) + 
				"w"+ progressWrap.offsetWidth); 

			// clearInterval(progressFlag);
			var length = e.pageX - getElementLeft(progressWrap);
			var percent = length / progressWrap.offsetWidth;
			playProgress.style.width = percent * (progressWrap.offsetWidth) - 2 + "px";
			video.currentTime = percent * video.duration;
			// progressFlag = setInterval(getProgress, 60);
			i=0;	//重置弹幕播放列表
			while(video.currentTime>barrages[i]['v_time'] && (i+1)<barrages.length){
				//点击进度条时更新弹幕列表
				i++;
			}
		});

		//获取元素绝对横坐标
		function getElementLeft(element){
	　　　　var actualLeft = element.offsetLeft;
	　　　　var current = element.offsetParent;
	　　　　while (current !== null){
	　　　　　　actualLeft += current.offsetLeft;
	　　　　　　current = current.offsetParent;
	　　　　}
	　　　　return actualLeft;
　　　　}
/*$(function(){
     $(window).keydown(function (event) {
        if (event.keyCode == 27) {
            alert("执行退出全屏操作...");
        }
    });

    //js模拟按键事件
	var e = jQuery.Event("keydown");
	e.keyCode=27;
	// e.ctrlKey=true;
	$("#testbtn").click(function(){
		$(window).trigger(e);
	});
});*/
	</script>
</body>
</html>