jQuery(document).ready(function($) {
	$('#tdl-tasks li .sp_task').click(function(el) {
		$(this).siblings("div").slideToggle();
	});
	
	$('#addTaskLable').click(function() {
		$('#addTaskForm').slideToggle();		
	});
	
	//TODO: Закончить добавление задач через AJAX
	$('#btn_addTask').click(function() {
		$.post(
				ajaxurl,
				{
					_ajax_nonce: ajaxTask.nonce,
					action: 'add_task',
					task: $('#txt_task').val()
				},
				function(data) {
					alert(data);
				}
				);
	});
	
	$('a#a_delete').click(function(event) {
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
