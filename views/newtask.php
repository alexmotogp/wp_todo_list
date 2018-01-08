<div>
	<h3>ToDo List New Task</h3>
	<form action="<?php home_url() ?>" method="post">
		<label>Task:</label><input type="text" name="task">
		<?php submit_button('+')?>
	</form>
</div>