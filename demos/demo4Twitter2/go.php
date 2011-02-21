<?php

  $username = $_GET['username'] && isset($_GET['username']) ? $_GET['username'] : 'mootools';
  $page = $_GET['page'] && isset($_GET['page']) ? $_GET['page'] : 1;
  $amount = 9;
  require_once('twitter-api/twitter.statuses.class.php');
  $twitter = new TwitterStatus($username, $amount);
  $result = $twitter->user_timeline($page);
  require_once('src/Template.class.php');
  $path = "templates/";

  $tpl = new CachedTemplate($path,'cache/',"id1".$username);
  $tpl->assign('title','PHP Template Engine');
  $tpl->display_cache('header.tpl.php');

  $body = new CachedTemplate($path,'cache/',"id2".$username);

  $a = new CachedTemplate($path,'cache/',"id3".$username);
  $a->assign('result',$result);
  $body->assign('label','Username: ');
  $body->assign('tweets', $a->fetch_cache('content.tweets.tpl.php'));

  $footer = new CachedTemplate($path,'cache/',"id4".$username);
  $footer->assign('written','thinkphp');
  $footer->assign('download','#');
  $body->assign('footer',$footer->fetch_cache('footer.tpl.php'));

  $body->display_cache('body.tpl.php');
?>
