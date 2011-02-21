<?php
  require_once('Template.class.php');
  $path = "templates/";
  $body = new Template($path);
  $users_fetch = array(
                 array("id"=>1,"name"=>"Adrian","department"=>"maths","email"=>"statescu@gmail.com"),
                 array("id"=>2,"name"=>"Adrian","department"=>"maths","email"=>"statescu@gmail.com"),
                 array("id"=>3,"name"=>"Adrian","department"=>"maths","email"=>"statescu@gmail.com"));
  $body->assign('users_list', $users_fetch);
  $tpl = new Template($path);
  $tpl->assign('title','Title Site');
  $tpl->assign('body',$body->fetch('body.tpl.php'));
  $tpl->display('index.tpl.php'); 
//http://public.intraface.dk/docs/Template/
?>