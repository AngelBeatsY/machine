$(function(){
	$(window).scrollTop(0);
});
$(window).scroll(function() {
	if ($(window).scrollTop()>=100 && $(".navbar").attr("marginTOP")=="15") {
		$(".navbar").animate({margin:"0"},"fast");
		$(".m-back").fadeIn();
		$(".m-back").animate({bottom:"160px"},"fast");
		$(".navbar").attr("marginTOP","0");
	}
	if ($(window).scrollTop()<100 && $(".navbar").attr("marginTOP")=="0") {
		$(".navbar").animate({margin:"15px"},"fast");
		$(".m-back").animate({bottom:"10px"},"fast");
		$(".m-back").fadeOut();
		$(".navbar").attr("marginTOP","15");
	}
});
$(function(){
	// $("#navbar-collapse li").slice(0,4).click(function(){
	// 	$(this).addClass("active");
	// });
	$("#navbar-collapse li").slice(0,4).mouseover(function(){
		if (!$(this).hasClass("active")) {
			$(this).addClass("active");
			$(this).mouseout(function(){
				$(this).removeClass("active");
			});
		}
	});
});
function navCheck(){
	if($("#nav-searchWords").val()==""){
		$("#nav-searchWords").focus();
		$("#nav-searchWords").attr("placeholder","怕是什么都没有输入哦~");
		return false;
	}else{
		return true;
	}
}
function adminLogin(){
	/*if($("#adminUsername").val()=="admin" && $("#adminPassword").val()=="admin"){
		window.location.href='/machine/public/mod/admin-mod.php';
	}else{
		$("#adminUsername").val("").focus().attr("placeholder","账号或密码错误！");
		$("#adminPassword").val("");
	}*/
	if($("#inputEmail").val()!="" && $("#inputPassword").val()!=""){
		$("#adminLoginForm").submit();
	}else{
		$("#inputEmail").val("").focus().attr("placeholder","账号或密码为空！");
		$("#adminPassword").val("");
		return false;
	}
}