PHP Template Engine
===================

Very simple template engine for PHP5 with same interface as Savant3 and Smarty. Assign content to engine, then display a template file.

How to use
----------

    //path/to/templates
    $path = 'templates/';

    //create an object
    $tpl = new Template($path);  

    //assign some content
    $tpl->assign('title','PHP Template Engine');

    //display the template
    $tpl->display('header.tpl.php');
    //create an object Template

    $body = new Template($path);
    //create an object Template

    $a = new Template($path);

    //assign some content
    //this would typically came froma database or other source,
    //but we'll use static value for the purpose of this example
    $a->assign('result', $result);
    $body->assign('label','Username: ');
    //assign from 
    $body->assign('tweets', $a->fetch('content.tweets.tpl.php'));
    //also, create an object Template
    $footer = new Template($path);
    //assigb static value
    $footer->assign('written','thinkphp');
    $footer->assign('download','#');
    //assign values from another fetching template.
    $body->assign('footer',$footer->fetch('footer.tpl.php'));
    //display the template
    $body->display('body.tpl.php');


It can be used with the following templates:


    <!-- header.tpl.php -->

    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title><?php echo$title;?></title>
    <style type="text/css">
    /* do something CSS */
    </style>
    </head>


    <!-- content.tweets.tpl.php -->
    if($result && is_array($result)) {

     $out = '<ol id="timeline" class="statuses">';
     $header = '<li><img src="'.$result[0]['user']['profile_image_url'].'">'.
                  '<div><strong>@'.$result[0]['user']['screen_name'].'</strong></div>'.
                  '<div>'.$result[0]['user']['location'].'</div>'.
                  '<div><a href="'.$result[0]['user']['url'].'">'.$result[0]['user']['url'].'</a></div>'.
                  '<div>'.$result[0]['user']['description'].'</div>'.
                  '</li>';

     $out .= $header;
     foreach($result as $r) {
     $out .= '<li>';
     $out .= '<span class="status-body">';
     $out .= '<span class="status-content">';
     $out .= '<span class="status-entry">';
     $out .= ($r['text']);  
     $out .= '</span>';
     $out .= '</span>';
     $out .= '<span class="meta entry-meta">';
     $out .= $r['created_at'];
     $out .= '</span>';
     $out .= '</li>';
     }
     $out .= '</ol>';
   
     } else {
       $out = 'No found results.';
     }
     //output the result
     echo$out;
   

   <!-- body.tpl.php -->

   <body>
   <div id="logo"><a href="#">Twitter</a></div>
   <form id="f" name="f">
      <label for="username"><?php echo$label;?></label><input type="text" id="username" name="username" value="<?php echo$_GET['username'];?>"/><input type="submit" value="Grab">
   </form>  
   <div id="content_tweets"><?php echo$tweets; ?></div>
   <?php echo$footer;?>
   </body>
   </html>

   <!-- footer.tpl.php -->

   <div id="ft"><p>Written by @<a href="http://twitter.com/thinkphp"><?php echo$written;?></a> | download on <a href="<?php echo$download;?>">GitHub</a></p></div>