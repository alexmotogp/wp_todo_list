<?php    
    if (! class_exists('ToDoList')) {
    
        class ToDoList
        {    
            private static $instance = false;
    
            private function __construct()
            {                
                add_action('init', array($this,'register_task_content_type'));
            }
            
            public static function getInstance()
            {
                if (!self::$instance) {
                    self::$instance = new self();
                }
                return self::$instance;
            }
            
            public function getTasks()
            {                
                $cur_user = get_current_user_id();
                $args = array(
                    'post_type' => 'tdl_tasks',
                    'author' => $cur_user
                );
                
                $tasks = array();
                $task = array();
                $loop = new WP_Query($args);
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $task['title'] = the_title('', '', false);
                    $task['id'] = get_the_ID();
                    $tasks[] = $task; 
                }                         
                
                return $tasks;
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
        }        
    }
 ?>