<lable for='tdl-select-users'><?php echo __('Select user:', 'tdl') ?></lable>
<select id='tdl-select-users'>
	<?php
    	foreach ($users as $user) {
            echo '<option>'.$user->user_login.'</option>';
    	}
    ?>
</select> <br/>
<input type="file" />