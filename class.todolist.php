<?php    
    if (! class_exists('ToDoList')) {
        require_once 'class.task.php';
        
        class ToDoList implements Iterator
        {    
            private $position;
            private $tasks = array();
            
            private static $instance = false;
            
            private function __construct()
            {                
                $this->getTasks();
                $this->rewind();                
            }
            
             public static function getInstance()
            {
                if (!self::$instance) {
                    self::$instance = new self();
                }
                return self::$instance;
            } 
            
            private function getTasks()
            {
                $cur_user = get_current_user_id();
                $args = array(
                    'post_type' => 'tdl_tasks',
                    'author' => $cur_user
                );
                
                $loop = new WP_Query($args);
                while ($loop->have_posts()) {
                    $loop->the_post();
                    $task = new tdlTask(get_the_ID(), the_title('', '', false), get_the_content());
                    $this->addTask($task);
                }
            } 
            
            public function addTask($task) 
            {
                if (get_class($task) == 'tdlTask')
                    $this->tasks[] = $task;
            }
    
            /**
             * {@inheritDoc}
             * @see Iterator::current()
             */
            public function current()
            {              
                return $this->tasks[$this->position];
            }
        
            /**
             * {@inheritDoc}
             * @see Iterator::key()
             */
            public function key()
            {
                return $this->position;                
            }
        
            /**
             * {@inheritDoc}
             * @see Iterator::next()
             */
            public function next()
            {
                ++$this->position;
            }
        
            /**
             * {@inheritDoc}
             * @see Iterator::rewind()
             */
            public function rewind()
            {
                $this->position = 0;                              
            }
        
            /**
             * {@inheritDoc}
             * @see Iterator::valid()
             */
            public function valid()
            {                
                return array_key_exists($this->position, $this->tasks);
            }
                                                        
        }        
    }
 ?>