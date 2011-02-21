<?php

/**
 *  PHP Template Engine.
 * 
 *  Implements the same interface as Savant3 and Smarty, but is more lightweight.
 *  It's is originally created in the Sitepoint article: http://www.sitepoint.com/article/beyond-template-engine
 *  @PHP5
 * 
 *  Usage:
 *  <?php
 *    $tpl = new Template('path/to/templates');
 *    $tpl->assign('variable','some value');
 *    $tpl->display('template');
 *  ?>
 */

class Template {
 
   public $vars;
   public $path;

   /*
    * Constructor of class
    * 
    * Sets the path to the template files. 
    *   
    * @param String $path => path to template files.
    * @return void
    */

    public function __construct($path=null) {
           $this->path = $path;
           $this->vars = array();   
    }  

   /*
    * @method
    * 
    * Sets a template variable
    *   
    * @param String $name => the name of the variable template to set.
    * @param String $value => the value of the variable template. 
    * @return void
    */
    
    public function assign($name, $value) {
           $this->vars[$name] = $value;
    }


   /*
    * @method
    * 
    * Sets a template variable
    *   
    * @param String $name => the name of the variable template to set.
    * @param String $value => the value of the variable template. 
    * @return void
    */
    
    public function set($name, $value) {
           $this->vars[$name] = $value;
    }

   /*
    * @method
    * 
    * Sets the path to the template files.
    *   
    * @param String $path => path to template files.
    * @return void.
    */

    public function setPath($path) {
        $this->path = $path;
    }


   /*
    * @method
    * 
    * Open, parse, and return the template file.
    *   
    * @param  (String) $file the template filename.
    * @return (String)
    */

    public function fetch($file) {
        //extract the vars to local namespace.
        extract($this->vars);

        //start output buffering.
        ob_start();

        //include the file
        include $this->path . $file;

        //get the contents of the buffer.
        $contents = ob_get_contents();

        //end buffering and discard.
        ob_end_clean();

       //return output String
      return($contents);  
    }

   /*
    * @method
    * 
    * Display the template directly.
    *   
    * @param  (String) $file the template filename.
    * @return (String)
    */

    public function display($file) {
       echo$this->fetch($file); 
    }
}   


/**
 *
 * An extension to Template providing a cached template
 *
 * Usage
 */
 
 class CachedTemplate extends Template {
 
       public $cache_id;
       public $expire;
       public $cached;

       /**
        *  Constructor of class
        *
        * @param String  $path              path to template files.
        * @param String  $path_cache_files  the place where to save cache files.
        * @param String  $cache_id          unique cache identifier.  
        * @param Integer $expire            number of seconds the cache will live; the age of cache. 
        *
        * @return void.
        */

        public function __construct($path, $path_cache_files='cache/', $cache_id=NULL, $expire=900) {
               parent::__construct($path);
               $this->cache_id = $cache_id ? $path_cache_files . md5($cache_id) : $cache_id;
               $this->expire = $expire;
        }

        /**
         * 
         * Test to see whether the currently loaded cache_id has a valid corresponding cache file.
         * 
         * @param void.
         * @return bool
         */
         public function isCached() {

             if($this->cached) {
                return true;
             }

             //passed a cache_id ? return true : return false;
             if(!$this->cache_id) {
                 return false;  
             }

             //test if cache file exists.
             if(!file_exists($this->cache_id)) {
                 return false; 
             } 

             //can get the time of the file?
             if(!$mtime=filemtime($this->cache_id)) {
                 return false;
             }  

             //if cache has expired ? return false : return true;
             if(($mtime + $this->expire) < time()) {

                 @unlink($this->cache_id);
                return false;

             /*
              * cache the results of this is_cached() call. Why ? So
              * we don't have to double the overhead for each template.
              * if we didn't cache, it would be hitting the file system
              * twice as much (file_exists() filemtime() => twice each)     
              */
             } else {

                 $this->cached = true;
                return true; 
             }
         } 


        /**
         * returns a cached copy of a template (if any, if it exists).
         * otherwise, it parses it as normal and caches the content.
         *   
         * @param String $file string the template file.
         * @return String (template output). 
         */

         public function fetch_cache($file) {

              if($this->isCached()) {

                 $fp = @fopen($this->cache_id, 'r');
                 $contents = fread($fp, filesize($this->cache_id));
                 fclose($fp);
                 return $contents; 

              } else {

                 $contents = $this->fetch($file);
                 //write to the cache
                 if($fp=fopen($this->cache_id,"w")) {
                    fwrite($fp, $contents);
                    fclose($fp); 
                 } else {
                    die('unable to write code'); 
                 } 

                return $contents;
              }
         }    

         public function display_cache($file) {

              echo$this->fetch_cache($file); 
         }
 }//end class Template_Cache
?>