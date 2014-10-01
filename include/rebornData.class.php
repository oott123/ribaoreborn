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
            $pdo = new PDO('mysql:host='. SAE_MYSQL_HOST_M. ';port='.  SAE_MYSQL_PORT. ';dbname='. SAE_MYSQL_DB. ';charset=utf8', SAE_MYSQL_USER,  SAE_MYSQL_PASS);
            $pdo->query('set names utf8;');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = new NotORM($pdo);
            $this->api = new rebornApi();
        }
        private function saveStory($data){
            $data = array(
                'id' => $data['id'],
                'date' => $data['date'],
                'title' => $data['title'],
                'body' => $data['body'],
                'image' => $data['image'],
                'thumbnail' => $data['thumbnail'],
                'url' => $data['share_url']
            );
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
        public function newStory($storyEntry, $date){
            $story = $this->getStory($storyEntry['id']);
            if(!$story){
                //获取、保存故事
                $story = $this->api->getStory($storyEntry['url']);
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
                $stories = $this->db->story()->where('date = ?', $date)
                    ->order('order_id DESC');
            }
            if(count($stories) < 1 || $force_refresh){
                $data = $this->api->getByDate($date);
                $stories = $data['news'];
                $date = $data['date'];
                foreach($stories as $story){
                    $this->newStory($story, $date);
                }
                return array_reverse($stories);
            }
            return $stories;
        }
        public function getNext($order_id, $date){
            $next = $this->db->story()->where('order_id < ? AND date = ?',
                $order_id, $date)->order('order_id DESC')->limit(1);
            if(count($next) < 1){
                return false;
            }
            return $next->fetch();
        }
    }