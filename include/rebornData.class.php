<?php
    /**
     * Class rebornData
     * 知乎日报的数据库模型类
     */
    class rebornData{
        private $db;
        private $api;
        private $pdo;
        public function __construct(){
            //兼容sae配置
            $this->pdo = new PDO('mysql:host='. SAE_MYSQL_HOST_M. ';port='.  SAE_MYSQL_PORT. ';dbname='. SAE_MYSQL_DB. ';charset=utf8', SAE_MYSQL_USER,  SAE_MYSQL_PASS);
            $this->pdo->query('set names utf8;');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = new NotORM($this->pdo);
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

        private function getKeyword($keyword){
            $keyword = explode(' ', $keyword);
            $keyword = array_map(array(__CLASS__, 'addPercent'), $keyword);
            $keyword = array_map(array($this->pdo, 'quote'), $keyword);
            return $keyword;
        }
        private function getLikeStr($column, $keyword){
            $like = implode(" OR `{$column}` LIKE ", $keyword);
            $like = "`{$column}` LIKE ".$like."";
            return $like;
        }
        private function getOrdStr($column, $rank, $keyword){
            $order = implode(" THEN {$rank} ELSE 0 END) + (CASE WHEN `{$column}` LIKE ", $keyword);
            $order = "((CASE WHEN `{$column}`` LIKE ". $order. " THEN {$rank} ELSE 0 END))";
            return $order;
        }
        public function searchByTitle($keyword, $offset = 0, $limit = 20){
            $keyword = $this->getKeyword($keyword);
            $like = $this->getLikeStr('title', $keyword);
            $order = $this->getOrdStr('title', 1, $keyword).'DESC, date DESC';
            $res = $this->db->story()->where($like)->order($order)
                ->limit($limit, $offset);
            return $res;
        }
        public function searchByContent($keyword, $orderByScore = false,
                                        $offset = 0, $limit = 20){
            $keyword = $this->getKeyword($keyword);
            $like = $this->getLikeStr('title', $keyword). ' OR '.
                $this->getLikeStr('body', $keyword);
            if($orderByScore){
                return $this->db->story()->where($like)->order("date DESC")
                    ->limit($limit, $offset);
            }else{
                $order = '('. $this->getOrdStr('title', 3, $keyword). '+'.
                    $this->getOrdStr('body', 2, $keyword). ')'
                    .'DESC, date DESC';
                return $this->db->story()->where($like)->order($order)
                    ->limit($limit, $offset);
            }
        }
        public static function addPercent($keywords){
            return '%'.$keywords.'%';
        }
    }