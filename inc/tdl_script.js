jQuery(document).ready(function($) {
	$('#tdl p').click(function() {
		$('#tdl-tasks').slideToggle();
	});
	$('#tdl-tasks').on('click', 'li .sp_task',function(el) {
		$(this).siblings("div").slideToggle();
	});
	
	$('#addTaskLable').click(function() {
		$('#addTaskForm').slideToggle();		
	});
	
	$('#btn_addTask').click(function() {
		var txtTask = $('#txt_task').val();
		var descTask = $('#ta_desc').val();
		var task_json = {"task":"" + txtTask + "", "desc":"" + descTask + ""};
		$.post(
				ajaxurl,
				{
					_ajax_nonce: ajaxTask.nonce,
					action: 'add_task',
					task: task_json
				},
				function(data) {					
					$('#tdl-tasks>ol').append(data);	
					$('#txt_task').val("");
					$('#ta_desc').val("");
				}
				);
	});
	
	$('#tdl-tasks').on('click', 'a#a_delete',function(event) {
		event.preventDefault();
		var cur_el = $(this); 
		$.post(
				ajaxurl,
				{
					_ajax_nonce: ajaxTask.nonce,
					action: 'del_task',
					task_id: cur_el.attr('href')
				},
				function(data) {
					if (data == 1) {
						cur_el.parents('li').remove();
					}					
				}
				);
	});
})
