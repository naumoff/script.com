<?php
$url = $_COOKIE['url'];
$file = $url.'/robots.txt';

$handle = fopen($file,'r');
if(!$handle){
	echo 'failed to open stream!'."\n";
}else{
	$fileSize = remote_filesize($file);
	setcookie('fileSize',$fileSize);
	echo "<pre>";
	echo "robots.txt for {$url} successfully opened!"."\n";
	echo "<a href='robots_read.php' target='_blank'>Read File</a>"."\n";
}

echo "<a href='/index.php'>Back!</a>";
	

function remote_filesize($url) {
	static $regex = '/^Content-Length: *+\K\d++$/im';
	if (!$fp = @fopen($url, 'rb')) {
		return false;
	}
	if (
		 isset($http_response_header) &&
		 preg_match($regex, implode("\n", $http_response_header), $matches)
	) {
		return (int)$matches[0];
	}
	return strlen(stream_get_contents($fp));
}

?>
</pre>
	