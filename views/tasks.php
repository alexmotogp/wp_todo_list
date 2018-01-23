<div id="tdl-tasks">
	<h3><?php echo __('ToDo List', "tdl")?></h3>
	<ol>
		<?php foreach ($tasks as $task):?>
		      <li>
		      	<span class='sp_task'><?php echo $task->getTask() ?></span>
		      	<span class='sp_buttons'>
		      		<a href="<?php echo get_edit_post_link($task->getId()) ?>"><?php echo __('Edit', "tdl") ?></a>
		      		<a id="a_delete" href="<?php echo plugins_url('deltask/id/'.$task->getId(), __FILE__.'/..') ?>"><?php echo __('Delete', "tdl") ?></a>
		      	</span>
		      <div><?php echo $task->getDescription() ?></div>  
		      </li>
		  <?php endforeach; ?>
	</ol>
	<div id="addTaskLable"><span><?php echo __('add task', 'tdl') ?></span></div>
	<div id="addTaskForm">
		<form action="">
			<div>
				<label for='txt_task'><?php echo __('Task', 'tdl') ?></label><br><input type='text' name='task' id='txt_task'>
			</div>
			<div>
				<label for='ta_desc'><?php echo __('Descriptiopn', 'tdl') ?></label><br><textarea rows="3" cols="70" name='desc' id='ta_desc'></textarea>
			</div>
			<div>
				<input type='button' id='btn_addTask' value="<?php echo __('Add', 'tdl') ?>">
			</div>
		</form>
	</div>
</div>
