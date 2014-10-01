<?php
    /**
     * Class rebornData
     * 知乎日报的数据库模型类
     */
    class rebornData{
        private $db;
        private $api;
        public function __construct(){
            $pdo = null;
            //兼容sae配置
            $pdo = new PDO('mysql:host='. SAE_MYSQL_HOST_M. ';port='.  SAE_MYSQL_PORT. ';dbname='. SAE_MYSQL_DB, SAE_MYSQL_USER,  SAE_MYSQL_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = new NotORM($pdo);
            $this->api = new rebornApi();
        }
        private function saveStory($data){
            try{
                $this->db->story()->insert($data);
            }catch (PDOException $e){
                return false;
            }
            return true;
        }
        public function getStory($id){
            $story = $this->db->story[$id];
            if($story){
                return $story;
            }else{
                return false;
            }
        }
        public function newStory($story, $date){
            $story = $this->getStory($story['id']);
            if(!$story){
                //获取、保存故事
                $story = $this->api->getStory($story['url']);
                $story['date'] = $date;
                $this->saveStory($story);
            }
            return $story;
        }
        public function getByDate($date = false, $force_refresh = false){
            if(!$date){
                $date = date('Ymd');
            }
            $stories = null;
            if(!$force_refresh){
                $this->db->story()->where('date = ?', $date);
            }
            if(!$stories || $force_refresh){
                $stories = $this->api->getByDate($date);
                foreach($stories as $story){
                    $this->newStory($story, $date);
                }
            }
            return $stories;
        }
    }