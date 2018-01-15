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
    
    class tdlMain {
        private static $instance = false;
        private $tdl;
        
        private function __construct() {            
            add_action('init', array($this,'register_task_content_type'));
            add_action('init', array($this,'initToDoList'));
            add_action('admin_enqueue_scripts', array($this, 'tdl_enqueueScripts'));
            add_action('admin_notices', array($this, 'tdl_showTasks'));
        }
        
        public function initToDoList()
        {
            $this->tdl = ToDoList::getInstance();
        }
        
        public static function getInstance() {
            if (!self::$instance)
                self::$instance = new self();
            return self::$instance;
        }
        
        public function register_task_content_type(){
            $labels = array(
                'name' => __('Task', 'task'),
                'singular_name' => __('Tasks', 'tasks'),
                'menu_name' => __('Tasks', 'tasks'),
                'name_admin_bar' => __('Task', 'task'),
                'add_new' => __('Add New', 'addnew'),
                'add_new_item' => __('Add New Task', 'addnewtask'),
                'new_item' => __('New Task', 'newtask'),
                'edit_item' => __('Edit Task', 'edittask'),
                'view_item' => __('View Task', 'viewtask'),
                'all_items' => __('All Tasks', 'alltasks'),
                'search_items' => __('Search Tasks', 'searchtasks'),
                'parent_item_colon'  => __('Parent Task:', 'parenttask'),
                'not_found' => __('No Tasks found', 'nofoundtask'),
                'not_found_in_trash' => __('No Tasks found in Trash', 'nofoundtrashtask'),
            );
            
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
            
            register_post_type('tdl_tasks', $args);
        }
        
        public function tdl_showTasks() {     
            global $post_type;
            if ($post_type == 'tdl_tasks')
                return '';
                $tasks = $this->tdl;
                require 'views/tasks.php';
        }
        
        public function tdl_enqueueScripts() {
            wp_enqueue_style('tdlStyle.css', plugin_dir_url(__FILE__).'/inc/tdlStyle.css');
            wp_enqueue_script('tdl_script', plugin_dir_url(__FILE__).'/inc/tdl_script.js');
            wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
        }
    }
    
    $tdl = tdlMain::getInstance();
 ?>