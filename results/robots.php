<?php
$url = $_COOKIE['url'];
$file = $url.'/robots.txt';

$handle = fopen($file,'r');
if(!$handle){
	$mess1 =  'файл robots.txt - отсутствует!';
	$warn1 = 'Программист: Создать файл robots.txt и разместить его на сайте';
}else{
	$fileSize = remote_filesize($file);
	setcookie('fileSize',$fileSize);
	$mess1 = "файл robots.txt на {$url} присутствует"."\n";
	$warn1 = "Доработки не требуются";
	echo "<pre><a href='robots_read.php' target='_blank'>Read File</a>"."\n";
}

echo "<a href='/index.php'>Back!</a>"."\n";
	

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

<table border="1">
	<caption style="text-align:left;">Резюме</caption>
	<thead>
		<tr>
			<th>Статус</th>
			<th>Необходимые действия</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $mess1 ?></td>
			<td><?php echo $warn1 ?></td>
		</tr>
	</tbody>
</table>

</pre>
	