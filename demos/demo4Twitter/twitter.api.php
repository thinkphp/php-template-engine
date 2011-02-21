<?php
/**
  * A minimalist PHP Twitter API
  * This API uses Basic Access Authentication 
  * sends user credentialsin the header at the HTTP request. This makes it easy to use, but insecure.
  * OAuth is the Twitter preffered method of authentication moving forward - "come August 2010. we'll 
  * be turning off Basic Auth from the API"
  *
  * @author Adrian Statescu
  * @version 0.3
  * @copyright (c) 2010 Adrian Statescu Dumitru
  * @URL: http://apiwiki.twitter.com/Twitter-API-Documentation
  *
  * Usage:
  *
  * $twitter = new Twitter('username','password');
  * 
  * //get the public timeline
  * $tweets = $twitter->statuses->public_timeline();
  *
  *
  */

class Twitter {
 
     private $username;
     private $password;
     private $format;
     private $uri;

     public function __construct($username, $password, $format='json', $uri=NULL) {

            if(!in_array($format,array('json','xml','rss','atom'))) {
                 throw new TwitterException("Unsupported format: $format");
            }
            $this->username = $username;             
            $this->password = $password;
            $this->format = $format;
            $this->uri = $uri;
     }

     public function __get($key) {

            return new Twitter($this->username,$this->password,$this->format,$key);
     } 

     public function __call($method,$args) { 

            $args = (count($args) && is_array($args[0]))? $args[0] : array();

            $curlopt = array(

                CURLOPT_USERPWD => sprintf("%s:%s",$this->username,$this->password),
                CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                CURLOPT_RETURNTRANSFER => TRUE,     
                CURLOPT_HTTPHEADER => array('Expect:')

            );

            $uri = ($this->uri) ? sprintf("%s/%s",$this->uri,$method) : $method; 
            
            if(array_key_exists('id',$args)) {

                $uri .= '/'.$args['id'];
                unset($args['id']);
            }

            $url = sprintf("%s.twitter.com/%s.%s",
                          ($method == 'search') ? 'search' : 'http://api',
                           $uri,
                           $this->format);  

            if(in_array($method, array('new', 'create', 'update', 'destroy'))) {

                  $curlopt[CURLOPT_POST] = TRUE;

                  if($args) $curlopt[CURLOPT_POSTFIELDS] = $args; 
            } elseif($args){

                  $url .= '?'.http_build_query($args);
            }
 
            //echo$url;
            $ch = curl_init($url);
            curl_setopt_array($ch, $curlopt);
            $data = curl_exec($ch); 
            $meta = curl_getinfo($ch);
            curl_close($ch);

            if($meta['http_code']!=200) {
  
               throw new TwitterException("Response Code: {$meta['http_code']} from \n\t{$url}");
            }

            if($this->format == 'json') {

                 return json_decode($data);
            }         

        return $data;
     }
}

class TwitterException extends Exception {}  
?>