<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title><?php echo$title;?></title>
<style type="text/css">
html,body{font-family: georgia,arial,verdana;font-size: 25px}
.note {padding-left: 220px}
#ft{font-size:80%;color:#888;margin:2em 0;font-size: 16px;padding-left: 230px}
#ft p a{color:#2FC2EF;}
form{background:#00B7FF;padding: 5px;-moz-box-shadow:5px 5px 7px rgba(33, 33, 33, 0.7);width: 55%;margin-left: 220px;margin-bottom: 10px}
* {margin:0;padding:0;}
div#content_tweets{width: 600px}
ol.statuses {font-size:14px;list-style:none outside none;}
ol.statuses > li:first-child {border-top:0 none;}
ol.statuses li.latest-status {
border-top-width:0;
line-height:1.5em;
padding:1.5em 0 1.5em 0.5em;}
ol.statuses li {
padding-left:0.5em;}
ol.statuses li {line-height:20px;}
.meta {color:#999999;display:block;font-size:11px;}
ol.statuses li.status, ol.statuses li.direct_message {border-bottom:1px solid #EEEEEE;line-height:20px;padding:10px 0 8px;position:relative;}
ol.statuses .latest-status .entry-content {font-size:1.77em;}
div#content_tweets {padding:0 220px;}
div#content_tweets {word-wrap:break-word;}
li:hover {background: #F7F7F7}
a{color: #2FC2EF}
h1{text-align: center;margin-bottom: 40px;margin-top: 10px}
h2.thumb {padding-bottom:20px;padding-left: 260px}
</style>
</head>
<body>
<h1><?php echo$title;?></h1>
<form id="f" name="f">
  <label for="search">Search:</label><input type="text" id="search" name="search" value="mootools"/><input type="submit" value="Go">
</form>  
<div id="content_tweets">
<?php echo$output; ?>
</div>
<div id="ft"><p>Created by @<a href="http://twitter.com/thinkphp">thinkphp</a></p></div>
</body>
</html>
