<div>
	<ol>
		<?php 
		  $tasks = ToDoList::getInstance()->getTasks();
		  foreach ($tasks as $task) {
		      echo '<li>'.$task.'</li>';
		  }
		?>
	</ol>
</div>
