<?php
App::uses('Component', 'Controller');

class RedisComponent extends Component {

    private $host = null;
    private $port = null;
    private static $instance = null;
    private $redis;
    
    public function __construct() {
        $this->host = '127.0.0.1';
        $this->port = 6379;
        $this->redis = new Redis(); 
        $this->redis->connect($this->host, $this->port);
    }

    public static function connect() {
        if(self::$instance == null) {
            self::$instance = new RedisComponent();
        }
        return self::$instance;
    }

    function getAllKeys(){
		return $this->redis->keys('*');
	}

    function removeKey($key){
		return $this->redis->del($key);
	}

	function setValue($key, $value){
		return $this->redis->set($key, $value);
	}

	function getValue($key){
		return $this->redis->get($key);
	}
}
