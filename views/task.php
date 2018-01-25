<?php if (isset($task)) : ?>

<li><span class='sp_task'><?php echo $task->getTask() ?></span> 
	<span class='sp_buttons'> <a
		href="<?php echo get_edit_post_link($task->getId()) ?>"><?php echo __('Edit', "tdl") ?></a>
		<a id="a_delete"
		href="<?php echo plugins_url('deltask/id/'.$task->getId(), __FILE__.'/..') ?>"><?php echo __('Delete', "tdl") ?></a>
	</span>
	<div><?php echo $task->getDescription() ?></div>
</li>

<?php endif;?>	