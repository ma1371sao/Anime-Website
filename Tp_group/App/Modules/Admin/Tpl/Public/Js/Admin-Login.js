// 封装tip函数
jQuery.fn.tip=function (options) {
	// 设置参数
	var settings = $.extend({ place:'right',text:'也许是最好的动画应用'}, options);
	// 文本
	var text     =settings.text;
	// 位置
	var place    =settings.place;
	// 获取高度
	var height= $(this).outerHeight()+10;
	var width = $(this).outerWidth()+10;
	// 获取提示元素
	var obj = $(".hint");
	var arrow= $(".hint").find(".arrow");
	// 改变文本
	obj.fadeIn();//显示文本
	obj.find("p").text(text);

	switch(place){
		case 'left':
			arrow.removeClass();
			arrow.addClass('arrow').addClass('arrow-right');
			obj.css('top',$(this).offset().top);
			obj.css('left',$(this).offset().left-obj.outerWidth()-10);
		break;
		case 'right':
			arrow.removeClass();
			arrow.addClass('arrow').addClass('arrow-left');
			obj.css('top',$(this).offset().top);
			obj.css('left',$(this).offset().left+width);
			obj.animate({
				opacity: 100
			}, 100);
		break;
		case 'top':
			arrow.removeClass();
			arrow.addClass('arrow').addClass('arrow-bottom');
			obj.css('top',$(this).offset().top-height);
			obj.css('left',$(this).offset().left);
		break;
		case 'bottom':
			arrow.removeClass();
			arrow.addClass('arrow').addClass('arrow-top');
			obj.css('top',$(this).offset().top+height);
			obj.css('left',$(this).offset().left);
			obj.animate({
				opacity: 100
			}, 100);
		break;
	}
}
// 验证标志
var a_flag = 0;
var p_flag = 0; 
// jquery代码
$(function(){
// 验证码
$("#change").click(function change_verify() {
	$("#code").attr("src",URL +'/'+ Math.random());
});
// logo渐现
$(".login-logo>img").fadeIn(1000);

// 对input的设置
$("form :input").bind("focus keyup",function(){
switch($(this).attr('id')){
	// 账号
	case 'account':
		if( $(this).val().length>0 ){
			a_flag=1;
			$(this).removeClass('login-error').addClass('login-success');
			$('.hint').hide();
		}else{
			a_flag=0;
			$(this).removeClass('login-success').addClass('login-error');
			$(this).tip({
				text:'请至少输入一个字符',
			});
		}
	break;
	// 密码
	case 'password':
		if( $(this).val().length>2&&$(this).val().length<10 ){
			p_flag=1;
			$(this).removeClass('login-error').addClass('login-success');
			$('.hint').hide();
		}else{
			p_flag=0;
			$(this).removeClass('login-success').addClass('login-error');
			$(this).tip({
				place:'right',
				text:'请输入2~10个字符',
			});
		}
	break;
}
});
// 定时清除
setInterval(function(){
	$("#submit").css('cursor','pointer');
},1000);
//监听提交时间 
$('form').submit(function(){
$('form :input').each(function(){
	switch($(this).attr('id')){
	// 账号
	case 'account':
		a_flag==1?$(this).removeClass('login-error').addClass('login-success'):$(this).removeClass('login-success').addClass('login-error');
	break;
	// 密码
	case 'password':
		p_flag==1?$(this).removeClass('login-error').addClass('login-success'):$(this).removeClass('login-success').addClass('login-error');
	break;
}
});
	var is_past= (a_flag==1&&p_flag==1)?true:false;
	if(is_past)
		$("#submit").css('cursor','pointer');
	else
		$("#submit").css('cursor','not-allowed');
	return is_past; 
});
});