<div>
	<h3>ToDo List New Task</h3>
	<form action="<?php echo add_query_arg(array('page' => 'todolist/views/newtask.php'), admin_url('admin.php')) ?>" method="post">
		<label>Task:</label><input type="text" name="task">
		<?php submit_button('Add')?>
	</form>
</div>