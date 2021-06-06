<?php
$api = 'ff6ad7bca202f8145f61c7e7ee2fd9ac';
$user_id = '94080682@N02';
$per_page = 10;

$xml = 'http://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key='.$api.'&user_id='.$user_id.'&per_page='.$per_page;

$flickr = simplexml_load_file($xml);
foreach($flickr->photos->photo as $p) {
    echo '<a href="http://www.flickr.com/photos/'.$p['owner'].'/'.$p['id'].'">';
    echo '<img src="http://farm'.$p['farm'].'.static.flickr.com/'.$p['server'].'/'.$p['id'].'_'.$p['secret'].'_s.jpg">';
    echo '</a>';
}

?>