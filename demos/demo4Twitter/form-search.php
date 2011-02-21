<?php
$search = $_GET['search'] && isset($_GET['search']) ? $_GET['search'] : 'mootools';
$page = $_GET['page'] && isset($_GET['page']) ? $_GET['page'] : 1;

require('twitter.api.php');

$twitter = new Twitter('thinkphp','no-PASSWORD');
$ob = $twitter->search(array('q'=>$search,'page'=>$page));
$res = $ob->results;

    require_once('Template.class.php');
    $path = "templates/";
    $tpl = new Template($path);
    $tpl->assign('title','PHP Template Engine');
  
    $body = new Template($path);
    $body->assign('res',$res);
    $tpl->assign('output', $body->fetch('controller.tpl.php'));
 
    $tpl->display('index.tpl.php');  
?>
