<?php
$url = $_COOKIE['url'];
$file = $url.'/robots.txt';

$handle = @fopen($file,'r');
if(!$handle){
	$mess1 =  'файл robots.txt - отсутствует!';
	$warn1 = 'Программист: Создать файл robots.txt и разместить его на сайте!';
}else{
	$fileSize = remote_filesize($file);
	$content = fread($handle,$fileSize);
	setcookie('fileSize',$fileSize);
	setcookie('content',$content);
	$mess1 = "файл robots.txt присутствует"."\n";
	$warn1 = "Доработки не требуются";
	echo "<pre><a href='robots_read.php' target='_blank'>Read File</a>"."\n";
}

echo "<a href='/index.php'>Back!</a>"."\n";

$pattern = "/^[^#]*host( )?:( )?/i";
if (preg_match_all($pattern,$content,$matches,PREG_SET_ORDER)){
	$mess2 = 'Директива HOST указана.';
	$warn2 = 'Доработки не требуются.';
}else{
	$mess2 = 'В файле robots.txt не указана директива Host';
	$warn2 = 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.';
}


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
<?php echo "<h2>{$url}</h2>"; ?>
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
		<tr>
			<td><?php echo $mess2 ?></td>
			<td><?php echo $warn2 ?></td>
		</tr>
	</tbody>
</table>

</pre>
	