<?php
    class rebornApi{
        const LATEST_API = 'http://news.at.zhihu.com/api/1.2/news/latest';
        const BEFORE_API = 'http://news.at.zhihu.com/api/1.2/news/before/%d';
        private $curl;
        public function __construct(){
            $this->curl = new Curl();
        }
        public function getLatest(){
            $json = $this->curl->get(self::LATEST_API);
            return json_decode($json, 1);
        }
        public function getByDate($date){
            $before = $this->get_next_day($date, 1);
            $url = sprintf(self::BEFORE_API, $before);
            $json = $this->curl->get($url);
            return json_decode($json, 1);
        }
        public function getStory($url){
            return json_decode($this->curl->get($url), 1);
        }
        public function get_next_day($day, $howmany = 1){
            //20130731
            $year = substr($day, 0, 4);
            $month = substr($day, 4, 2);
            $day2 = substr($day, 6);
            $now = "{$year}-{$month}-{$day2} 08:00:00";
            $now = strtotime($now)+$howmany*60*60*24;
            return date('Ymd',$now);
        }
    }