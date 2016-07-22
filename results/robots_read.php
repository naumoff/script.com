<pre>
<?php
$url = $_COOKIE['url'];
$file = $url.'/robots.txt';
$handle = fopen($file,'r');

$fileSize = $_COOKIE['fileSize'];
$content = $_COOKIE['content'];
print_r($content);

fclose($handle);
?>
</pre>