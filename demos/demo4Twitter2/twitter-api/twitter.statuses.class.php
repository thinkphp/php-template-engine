<?php

    class TwitterStatus {

          /* vars members */ 
          public $username;
          public $format = 'json';
          public $amount = 10;
          public $page = NULL;
  
          /* one constant */
          const TWITTER_ENDPOINT = "http://twitter.com/statuses/"; 

          /* constructor of class */
          public function __construct($username,$amount) {
                 $this->username = $username;
                 $this->amount = $amount; 
                 $this->page = 1;
          }
          /* magical method __call */
          public function __call($method,$args) {

                 $this->page = $args[0];
                 $url = sprintf("%s%s/%s.%s?count=%s&page=%s",self::TWITTER_ENDPOINT,$method,$this->username,$this->format,$this->amount,$this->page);
                 $ch = curl_init();
                 curl_setopt($ch,CURLOPT_URL,$url);
                 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                 curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
                 curl_setopt($ch,CURLOPT_TIMEOUT,3);
                 $data = curl_exec($ch);
                 $info = curl_getinfo($ch);
                 curl_close($ch);
                 if(intval($info['http_code']) == 200) {
                     return json_decode($data, true);  
                 } else {
                   return false;  
                 }
          }
    } 

    class TwitterException extends Exception {}  
?>