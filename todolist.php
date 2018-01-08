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

//Этот плагин будет использовать базу данных для хранения записей списка задач, возможность добавления, удаления и редактирования задач в 
//админ панели
//Для начала реализую с помощью архива (данные будут удаляться после использования)
    
    if (! class_exists('ToDoList')) {
    
        class ToDoList
        {
    
            private static $instance = false;
            private $tasks = array();
            private $message = '';
    
            private function __construct()
            {                
                $this->addTask('task 1');
                $this->addTask('task 2');
                $this->addTask('task 3');
                add_action('admin_menu', array($this, 'showMenu'));
                add_action("admin_notices", array($this, 'showMessage'));
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
                return $this->tasks;
            }
            
            public function showMenu()
            {
                add_menu_page(
                    'ToDo List',
                    'ToDo List',
                    'manage_options',
                    plugin_dir_path(__FILE__).'views/todolistview.php',
                    null
                    );
                add_submenu_page(
                    plugin_dir_path(__FILE__).'views/todolistview.php',
                    'New task',
                    'New task',
                    'manage_options',
                    plugin_dir_path(__FILE__).'views/newtask.php'
                    );
            }
            
            private function setMessage(string $mes)
            {
                $this->message = $mes;
            }
            
            public function showMessage()
            {
                echo "<h1>$this->message</h1>";
            }
        }
        
        $tdl = ToDoList::getInstance();
    }
 ?>