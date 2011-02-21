<?php

if($res && is_array($res)) {
   $i = $_GET['page'] ? $_GET['page']+1 : 2;
   $out = '<ol id="timeline" class="statuses">';
  foreach($res as $r) {
    $out .= '<li><span class="status-body">';
    $out .= '<span class="status-content">';
    $out .= '<span class="status-entry">';
    $out .= tweetify($r->text);  
    $out .= '</span>';
    $out .= '</span>';
    $out .= '<span class="meta entry-meta">';
    $out .= $r->created_at;
    $out .= '</span>';
  }
$out .= '</ol>';
$out .= '<div><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">next</a></div>';
} else {
  $out = 'No found results.';
}
function tweetify($text) {
       $text = preg_replace("/(https?:\/\/[\w\-:;?&=+.%#\/]+)/i", '<a href="$1">$1</a>',$text);
       $text = preg_replace("/(^|\W)@(\w+)/i", '$1<a href="http://twitter.com/$2">@$2</a>',$text);
       $text = preg_replace("/(^|\W)#(\w+)/i", '$1#<a href="http://search.twitter.com/search?q=%23$2">$2</a>',$text); 
     return $text;
}
echo$out;
?>