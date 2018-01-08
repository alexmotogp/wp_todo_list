<?php 
    $tdl = ToDoList::getInstance();
    $tasks = $tdl->getTasks();
?>
<div>
	<ol>
		<?php 
		  foreach ($tasks as $task) {
		      echo '<li>'.$task.'</li>';
		  }
		?>
	</ol>
</div>
