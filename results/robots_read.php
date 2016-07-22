<pre>
<?php
$url = $_COOKIE['url'];
$file = $url.'/robots.txt';
$handle = fopen($file,'r');

$fileSize = $_COOKIE['fileSize'];
$content = fread($handle,$fileSize);
print_r($content);

fclose($handle);
?>
</pre>