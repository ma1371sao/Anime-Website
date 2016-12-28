(function($) {
	/**
	 * [Slide description]
	 * @param	during:延迟3s [description]
	 * @param	btn:t显示按钮		[description]
	 * @param	focus:true	[description]
	 * @param	title:true	[description]
	 * @param	auto:true	 [description]
	 */
	$.fn.extend({
		Slide:function(options){
		var defaults = {//默认参数
			during:3000,/**轮换间隔时间，单位毫秒*/
			btn:true,	 /**是否显示左右按钮*/
			focus:true, /**是否显示焦点按钮*/
			title:true, /**是否显示标题*/
			auto:true	 /**是否自动播放*/
		}
		var options = $.extend(defaults, options);
		return this.each(function(){
			var o					 = options;//操作
			var curr_index	= 0;//目前

			var $this = $(this);//当前对象
			var $li	 = $this.find("li");//li

			var liCount = $li.length;//li的个数
			// ul
			$this.css({
				position:'relative',
				overflow:'hidden',
				width:$li.find("img").width(),
				height:$li.find("img").height()
			});
			// li
			$this.find("li").css({
				position:'absolute',
				left:0,
				top:0
			}).hide();
			// 显示第一个
			$li.first().show();
			// 两侧按钮
			$this.append('<div class="ppt-btn"><span class="left_btn"><\/span><span class="right_btn"></span><\/div>');
			// 显示按钮
			if(!o.btn)	$(".ppt-btn").css({visibility:'hidden'});
			// 文字显示
			if(o.title) $this.append('<div class="ppt-title"><\/div><a href="" class="ppt-t"><\/a>');
			// 焦点按钮
			if(o.focus) $this.append('<div class="ppt-focus"><\/div>');
			var $btn		= $(".ppt-btn span");
			var $title		= $(".ppt-t");
			var $title_bg = $(".ppt-title");
			var $focus		= $(".ppt-focus");
			//如果自动播放，设置定时器
			if(o.auto){
					var t = setInterval(function(){
						$btn.last().click()
					},o.during);
			}

			$title.text($li.first().find("img").attr("alt")); 
			$title.attr("href",$li.first().find("a").attr("href"));
			// 输出焦点按钮
			for(i=1;i<=liCount;i++){
					$focus.append('<span>'+i+'</span>');
			}
			// // 兼容IE6透明图片	 
			// if($.browser.msie && $.browser.version == "6.0" ){
			//		 $btn.add($focus.children("span")).css({backgroundImage:'url(../Image/ico.gif)'});
			// }		
			var $f = $focus.children("span");
			$f.first().addClass("hover");
			// 鼠标覆盖左右按钮设置透明度
			// $btn.hover(function(){
			//		 $(this).addClass("hover");
			// },function(){
			//		 $(this).removeClass("hover");
			// });
			//鼠标覆盖元素，清除计时器
			$btn.add($li).add($f).hover(function(){
				if(t) clearInterval(t);
			},function(){
				 if(o.auto) t = setInterval(function(){$btn.last().click()},o.during);
			});
			//鼠标覆盖焦点按钮效果
			$f.bind("mouseover",function(){
				var i = $(this).index();
				$(this).addClass("hover");
				$focus.children("span").not($(this)).removeClass("hover");
				$li.eq(i).fadeIn(300);
				$li.not($li.eq(i)).fadeOut(300); 
				$title.text($li.eq(i).find("img").attr("alt"));
				curr_index = i;
			});
			//鼠标点击左右按钮效果
			$btn.bind("click",function(){
				// 按了按个按钮
				$(this).index() == 1?curr_index++:curr_index--;
				// 越界处理
				if(curr_index >= liCount) curr_index = 0;
				if(curr_index < 0) curr_index = liCount-1;
				// 逐渐显现
				$li.eq(curr_index).fadeIn(300);
				$li.not($li.eq(curr_index)).fadeOut(300);	

				$f.eq(curr_index).addClass("hover");
				$f.not($f.eq(curr_index)).removeClass("hover");

				$title.text($li.eq(curr_index).find("img").attr("alt"));
				$title.attr("href",$li.eq(curr_index).find("a").attr("href")); 
			});
	})
	}
	})
})(jQuery);
/**
 * 导航特效设置
 * @param	{[type]} option [description]
 * @return {[type]}				[description]
 */
$.fn.headroom = function(option) {
return this.each(function() {
	var $this	 = $(this),
		data			= $this.data('headroom'),
		options	 = typeof option === 'object' && option;

	options = $.extend(true, {}, Headroom.options, options);

	if (!data) {
		data = new Headroom(this, options);
		data.init();
		$this.data('headroom', data);
	}
	if (typeof option === 'string') {
		data[option]();
	}
});
};
/**
 * 首页ppt设置
 * @return {[type]} [description]
 */
$(function(){
/**
 * 首页ppt控制块
 * @type {[type]}
 */
	$(".ppt").Slide({auto:true});
/**
 * 首页菜单控制块
 * @return {[type]} [description]
 */
	$("#nav-js").hover(function(){
		$(".sub-guide").animate({height:'34px'},250);
	},function(){
		$(".tail").hide();
		$(".sub-guide").animate({height:'2px'},150);
	});
/**
 * 菜单导航动画序列
 * @return {[type]} [description]
 */
$(".main-li").each(function (){
	$(this).hover(function(){
		$(".tail").hide();
		// tail
		var tail = $(this).find(".main-li-a .tail");
		var tail_l =$(this).find('.main-li-a').width()/2-8;
		tail.css('left',tail_l);
		
		var target = $(this).attr("data-channel");
		
		var left = $(this).find('.main-li-a').offset().left;
		// 匹配目标
		var sub= $(".sub-nav[data-id="+target+"]");
		sub.css('left',left-sub.width()/4);
		// 注意语句的执行次序
		tail.show();
		$(".sub-guide ul").hide();
		sub.show();
	});
});//一级菜单li
/**
 * 动态效果控制块
 * @return {[type]} [description]
 */
	$(".sub-nav li a").hover(function(){
		$(this).animate({
			color: '#ff7f50',
		},100);
	},function(){
		$(this).animate({
			color: '#333',
		},100);
	});
	$(".p_color").hover(function(){
		$(this).animate({
			color: '#ff7f50',
		},100);
	},function(){
		$(this).animate({
			color: '#333',
		},100);
	});
	$(".sub-tit").hover(function(){
		$(this).animate({
			backgroundColor:"#9ed900",
			color: '#fff',
		},150);
	},function(){
		$(this).animate({
			backgroundColor:"#fff",
			color: '#999',
		},100);
	});
	$(".warpper-img").hover(function(){
		$(this).parents('li.l').find(".p-title").animate({
			color: '#3b8dbd',
		},150);
	},function(){
		$(this).parents('li.l').find(".p-title").animate({
			color: '#333',
		},150);
	})
	$(".p-title").hover(function(){
		$(this).animate({
			color: '#3b8dbd',
		},150);
	},function(){
		$(this).animate({
			color: '#333',
		},100);
	});
/**
 * 导航条特效配合jquery的语句
 * @return {[type]} [description]
 */
	$('[data-headroom]').each(function() {
	var $this = $(this);
		$this.headroom($this.data());
	});
/**
 * jquery tab 的js
 */
	// var tab_h = $('.u_control');
	// var tab_d = $('.side_ul');
	// $('.side').each(function(){
	// 	$(this).find('.side_ul').eq(0).show().siblings('.side_ul').hide();
	// 	$(this).find('.u_control').eq(0).addClass('side_active').siblings().removeClass('side_active');
	// 	tab_h.bind('click' , function(){
	// 	// 保证只有一个active
	// 	$(this).addClass('side_active').siblings().removeClass('side_active');
	// 	// 保证只显示一个主题
	// 	tab_d.eq($(this).index()+1).fadeIn().siblings('.side_ul').hide();
	// });
	// });

/**
 * 返回顶部的js
 */
	$.fn.scrolltoTop = function(options) {
		// 默认设置
	    var defaults = { 
	        speed : 500
	    };
	    // 合并操作
	    var options = $.extend(defaults,options);
	    // 选取元素
	    var $top   	= $(this);//面板
	    var $ta    	= $(this).find('a');
	     
	    $top.hover(function(){       
	        $(this).find('i').hide();
	        $(this).find('p.noshow').show();    
	    },function(){
	    	$(this).find('p.noshow').hide();          
	        $(this).find('i').show();   
	    }); 
	    $top.click(function(){
	        $("html,body").stop().animate({scrollTop: 0}, options.speed);
	        return false; 
	    });
	}
	$('#top').scrolltoTop();
	$(window).scroll(function (){
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn(500);
        } else {
            $('#top').fadeOut(500);
        }
	});
	/**
	 * lazyload
	 * 图片预加载
	 */
	// $("img.lazy").lazyload({
	// 	placeholder:"../Image/grey.gif",
	// 	effect: "fadeIn"
	// });
	/*
	 * 侧边每日导航
	 */
	$("#update_menu .menu_body:eq(0)").show();
	$("#update_menu div.menu_head").click(function(){
		$(this).addClass("current").nextAll("ul.menu_body:eq(0)").slideDown(300).siblings("ul.menu_body").slideUp(300);
		$(this).siblings().removeClass("current");
		$(this).next("a.menu_guide").removeClass("under").siblings("a.menu_guide").addClass("under");
		$(this).find("span").addClass("menu_san");
		$(this).siblings("div.menu_head").find("span").removeClass("menu_san");
	});
})