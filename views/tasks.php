<div id="tdl">
	<p><?php _e('You have <b>'.$tasksCount.'</b> tasks', 'tdl')?></p>
    <div id="tdl-tasks" class="<?php echo $isTurn?'hide_tasks':'' ?>">
    	<h3><?php echo __('ToDo List', 'tdl')?></h3>    	
    	<ol>
    		<?php foreach ($tasks as $task):?>
    		      <?php require 'task.php';?>
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
</div>