<?php

/**
 *  Template engine.
 * 
 *  Implements the same interface as Savant3 and Smarty, but is more lightweight.
 *  It's is originally created in the Sitepoint article: http://www.sitepoint.com/article/beyond-template-engine
 *  @PHP5
 * 
 *  Usage:
 *
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

?>