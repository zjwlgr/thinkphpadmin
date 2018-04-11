$(function(){


	var offset = $('.left').offset();
	$(window).scroll(function () {
		var scrollTop = $(window).scrollTop();
		if (offset.top < scrollTop) {
			$('.left').addClass('jieti_top_pos');

		} else {
			$('.left').removeClass('jieti_top_pos');

		}
	});


	$(".mihlai").bind("click", function(){
		var $gingi = $(this).attr("_i");
		$(".mihlai").removeClass('lcick');
		$(this).addClass('lcick');
		$("html,body").animate({scrollTop:($("#mj_"+$gingi).offset().top - 10)},500)
		return false;
	});





	$(".denglu").click(function(){
		if($("#username").val() == ""){
			art.dialog({fixed: true,lock: true,opacity: 0.15,title: '系统提示',content: '请输入你的真实姓名全拼',icon: 'warning',ok: function(){$("#username").focus();}});
			return false;
		}else if($("#password").val() == ""){
			art.dialog({fixed: true,lock: true,opacity: 0.15,title: '系统提示',content: '请输入密码',icon: 'warning',ok: function(){$("#password").focus();}});
			return false;
		}else{
			$.post("/Api/Document/login_action?t="+(new Date()).getTime(),$('#loginform').serialize(),function(data){
				if(data.error == 1){
					window.location.href = data.url;
				}else{
					art.dialog({fixed: true,lock: true,opacity: 0.15,title: '系统提示',content: data.msg,icon: 'warning',ok: function(){}});
				}
			},'json');
			return false;
		}
	});
});