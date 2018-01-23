<?php

    /**
     * @author Alexander Zenchenko     
     *
     */
    class tdlTask {
        private $id;
        private $task;
        private $description;
        
        public function __construct(int $id = 0, string $task = '', string $desc = '') {
            $this->setId($id);
            $this->setTask($task);
            $this->setDescription($desc);
        }
        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }
        
        private function setId($id)
        {
            $this->id = $id;
        }
    
        /**
         * @return mixed
         */
        public function getTask()
        {
            return $this->task;
        }
    
        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
        }
    
        /**
         * @param mixed $task
         */
        public function setTask($task)
        {
            $this->task = $task;
        }
    
        /**
         * @param mixed $description
         */
        public function setDescription($description)
        {
            //$description = 
            $this->description = $description;
        }
        
    }
?>