<?php

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
     $out .= tweetify($r['text']);  
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

function tweetify($text) {
       $text = preg_replace("/(https?:\/\/[\w\-:;?&=+.%#\/]+)/i", '<a href="$1">$1</a>',$text);
       $text = preg_replace("/(^|\W)@(\w+)/i", '$1<a href="http://twitter.com/$2">@$2</a>',$text);
       $text = preg_replace("/(^|\W)#(\w+)/i", '$1#<a href="http://search.twitter.com/search?q=%23$2">$2</a>',$text); 
      return $text;
}

//output the result
echo$out;
?>
