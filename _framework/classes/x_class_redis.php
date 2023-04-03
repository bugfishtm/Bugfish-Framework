<?php
	/*	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  REDIS Class */	
	class x_class_redis {
		private $redis  	= false; 		
		private $pre  	= false; 		
		function __construct($host, $port, $pre = "") { $redis = new Redis(); $redis->connect($host, $port); $this->redis = $redis;$this->pre = $pre; }
		public function redis() { return $this->redis; }
		public function ping() { return $this->redis->ping(); }
		public function keys() { return $this->redis->keys("*"); }
		public function add_string($name, $value) { 
			if(is_string($value) AND is_string($name)) {
				return $this->redis->set($this->pre.$name, $value); 
			} return false;
		}
		public function add_list($name, $value) { 
			if(is_array($value) AND is_string($name)) {
				foreach($value AS $key =>$valuex) {
					$this->redis->lpush($this->pre.$name, $valuex); 
				}
			}
		}
		public function get_string($name) { 
			if(is_string($name)) {
				return $this->redis->get($this->pre.$name); 
			} return false;
		}
		public function get_list($name, $start, $end) { 
			if(is_string($name)) {
				 return $redis->lrange($this->pre.$name, $start , $end); 
			} return false;
		}
	}
?>