<?php
	//简单的文件缓存
class SScache{
	private $cache_dir;
	private $cache_ttl;
	private $cache_fix;
	private $cache_sae;

	function __construct($dir,$ttl,$fix='.cache.php'){
		$this->cache_ttl = $ttl;
		if(function_exists('memcache_init')){
			if($this->cache_sae = memcache_init()){
				return true;
			}
		}
		$this->cache_dir = rtrim($dir,'/').'/';
		if(!is_dir($this->cache_dir)){
			mkdir($this->cache_dir,1);
		}
		$this->cache_fix = $fix;
	}

	function set($name,$data){
		$key = md5($name);
		if($this->cache_sae){
			return memcache_set($this->cache_sae,$key,$data,MEMCACHE_COMPRESSED,$this->cache_ttl);
		}
		return file_put_contents($this->cache_dir.$key.$this->cache_fix, serialize($data));
	}

	function get($name){
		$key = md5($name);
		if($this->cache_sae){
			return memcache_get($this->cache_sae,$key);
		}
		$cache_file = $this->cache_dir.$key.$this->cache_fix;
		if(is_file($cache_file)){
			if(($this->cache_ttl > 0) && (time() - filemtime($cache_file) > $this->cache_ttl)){
				unlink($cache_file);
				return false;
			}
			return unserialize(file_get_contents($cache_file));
		}
	}

	function clear($name=false){
		$key = false;
		if(!$name){
			$key = '*'.$this->cache_fix;
		}else{
			$key = md5($key).$this->cache_fix;
		}
		$files = glob($this->this->cache_dir.$key);
		foreach ($files as $af) {
			unlink($af);
		}
	}
}
