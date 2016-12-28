$(function(){
	/**
	 * 点击删除私信
	 * @return {[type]} [description]
	 */
	$('.del').click(function(){
		var is_Del = confirm('确定删除该私信？');
		var id_Del = $(this).attr('del-id');
		var div	= $(this).parents('.letter');
		if(is_Del){
			// ajax
			$.post('letterDel',{id : id_Del},function (data){
				if(data==1){
					div.slideUp('slow',function() {
						div.remove();
					});
				}else{
					alert('删除失败');
				}
			},'json')
		}
	});
});