<div id="tdl-tasks">
	<h3><?php echo __('ToDo List', "tdl")?></h3>
	<ol>
		<?php 
		  foreach ($tasks as $task) {
		      echo '<li>'.$task->getTask().' <span><a href="'.get_edit_post_link($task->getId()).'">'.__('Edit', "tdl").'</a><a href="">'.__('Delete', "tdl").'</a></span>';
		      echo '<div>'.$task->getDescription().'</div>';    
		      echo '</li>';
		  }
		?>
	</ol>
</div>
