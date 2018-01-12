<?php
/**
 * @package ToDo_List
 * @version 1.0
 */
/*
 Plugin Name: ToDo list
 Plugin URI: localhost
 Description: Show ToDo list for me in admin notices.
 Author: Alexander Zenchenko
 Version: 1.0
 Author URI: localhost
 */

require_once 'class.todolist.php';

add_action('admin_enqueue_scripts', 'tdl_enqueueScripts');

$tdl = ToDoList::getInstance();

add_action('admin_notices', 'tdl_showTasks');

function tdl_showTasks() {
    global $tdl;
    global $post_type;
    if ($post_type == 'tdl_tasks')
        return '';
    $tasks = $tdl->getTasks();
    require 'views/tasks.php';
}

function tdl_enqueueScripts() {
    wp_enqueue_style('tdlStyle.css', plugin_dir_url(__FILE__).'/inc/tdlStyle.css');
}

 ?>