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
        
        private const AJAX_TRUE = 1;
        private const AJAX_FALSE = 0;
        
        private static $instance = false;
        private $tdl;
        private $tdlNonce;
        
        private function __construct() {            
            add_action('init', array($this,'register_task_content_type'));
            add_action('init', array($this,'initToDoList'));
            add_action('admin_enqueue_scripts', array($this, 'tdl_enqueueScripts'));
            add_action('admin_notices', array($this, 'tdl_showTasks'));
            add_action('wp_ajax_add_task', array($this, 'ajaxAddTask'));
            add_action('wp_ajax_del_task', array($this, 'ajaxDelTask'));
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
                'name' => __('Task', 'tdl'),
                'singular_name' => __('Tasks', 'tdl'),
                'menu_name' => __('Tasks', 'tdl'),
                'name_admin_bar' => __('Task', 'tdl'),
                'add_new' => __('Add New', 'tdl'),
                'add_new_item' => __('Add New Task', 'tdl'),
                'new_item' => __('New Task', 'tdl'),
                'edit_item' => __('Edit Task', 'tdl'),
                'view_item' => __('View Task', 'tdl'),
                'all_items' => __('All Tasks', 'tdl'),
                'search_items' => __('Search Tasks', 'tdl'),
                'parent_item_colon'  => __('Parent Task:', 'tdl'),
                'not_found' => __('No Tasks found', 'tdl'),
                'not_found_in_trash' => __('No Tasks found in Trash', 'tdl'),
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
            wp_enqueue_script('tdl_script', plugin_dir_url(__FILE__).'/inc/tdl_script.js', array('jquery'));
            
            $this->tdlNonce = wp_create_nonce('tdlTask');
            wp_localize_script('tdl_script', 'ajaxTask', array('nonce' => $this->tdlNonce));                                   
        }
        
        public function ajaxAddTask() {
            check_ajax_referer('tdlTask');            
            //Получаю данные от скрипта
            sanitize_post($_POST);
            $postData = $_POST['task'];            
            $task = new tdlTask(0, $postData['task'], $postData['desc']);    
            $id = wp_insert_post($task->_toPostFormat());
            if(!$id){
                wp_die(__('Error: The task was not added!', 'tdl'));
            };            
            $task->setId($id);
            $this->tdl->addTask($task);
            require_once 'views/task.php';
            wp_die();
        }
        
        public function ajaxDelTask() {
            check_ajax_referer('tdlTask');
            sanitize_post($_POST);
            $taskId = $_POST['task_id'];
            $taskId = explode('/', $taskId);
            $taskId = array_pop($taskId);        
            if ($this->tdl->haveID($taskId))
                wp_die(self::AJAX_FALSE);
            if(!wp_delete_post($taskId)) {
                wp_die(self::AJAX_FALSE);                
            }            
            wp_die(self::AJAX_TRUE);
        }
    }
    
    $tdl = tdlMain::getInstance();
 ?>