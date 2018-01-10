<?php
/**
 * @package ToDo_List
 * @version 1.0
 */
/*
 Plugin Name: ToDo list
 Plugin URI: localhost
 Description: Show ToDo list for admins in admin notices
 Author: Alexander Zenchenko
 Version: 1.0
 Author URI: localhost
 */

//Ётот плагин будет использовать базу данных дл€ хранени€ записей списка задач, возможность добавлени€, удалени€ и редактировани€ задач в 
//админ панели
//ƒл€ начала реализую с помощью архива (данные будут удал€тьс€ после использовани€)
    
    if (! class_exists('ToDoList')) {
    
        class ToDoList
        {
    
            private static $instance = false;
    
            private function __construct()
            {                
                $this->addTask('task 1');
                $this->addTask('task 2');
                $this->addTask('task 3');
                add_action('init', array($this,'register_task_content_type'));
                add_action("admin_notices", array($this, 'getTasks'));
            }
            
            public static function getInstance()
            {
                if (!self::$instance) {
                    self::$instance = new self();
                }
                return self::$instance;
            }
    
            public function addTask(string $task)
            {
                $this->tasks[] = $task;
            }
            
            public function getTasks()
            {
                global $post_type;
                if ($post_type == 'tdl_tasks')
                    return '';
                $args = array(
                    'post_type' => 'tdl_tasks'
                );
                $loop = new WP_Query($args);
                echo '<ol>';
                while ($loop->have_posts()) {
                    $loop->the_post();
                    the_title('<li>', '</li>');
                }
                echo '</ol>';
            }         
            
            private function setMessage(string $mes)
            {
                $this->message = $mes;
            }
            
            public function register_task_content_type(){
                //Ћейблы типа постов
                $labels = array(
                    'name' => 'Location',
                    'singular_name' => 'Tasks',
                    'menu_name' => 'Tasks',
                    'name_admin_bar' => 'Task',
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New Task',
                    'new_item' => 'New Task',
                    'edit_item' => 'Edit Task',
                    'view_item' => 'View Task',
                    'all_items' => 'All Tasks',
                    'search_items' => 'Search Tasks',
                    'parent_item_colon'  => 'Parent Task:',
                    'not_found' => 'No Tasks found.',
                    'not_found_in_trash' => 'No Tasks found in Trash.',
                );
                                   
                //аргументы типа постов
                $args = array(
                    'labels' => $labels,
                    'public' => false,
                    'publicly_queryable'=> true,
                    'show_ui' => true,
                    'show_in_nav' => true,
                    'query_var' => true,
                    'hierarchical' => false,
                    'supports' => array('title','thumbnail','editor'),
                    'has_archive' => true,
                    'menu_position' => 20,
                    'show_in_admin_bar' => true,
                    'menu_icon' => 'dashicons-location-alt',
                    'rewrite' => array('slug' => 'tasks', 'with_front' => 'true')
                );
                //регистраци€ типа постов
                register_post_type('tdl_tasks', $args);
            }
        }
        
        $tdl = ToDoList::getInstance();
    }
 ?>