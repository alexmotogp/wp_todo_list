<div id="tdl-tasks">
	<h3><?php echo __('ToDo List', "tdl")?></h3>
	<ol>
		<?php 
		  foreach ($tasks as $task) {
		      echo '<li>'.$task['title'].' <span><a href="'.get_edit_post_link($task['id']).'">Edit</a><a href="">Delete</a></span></li>';
		  }
		?>
	</ol>
</div>
