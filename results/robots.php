<?php
$url = $_COOKIE['url'];
$file = $url.'/robots.txt';

$handle = @fopen($file,'r');
if(!$handle){
	$mess1 = 'файл robots.txt - отсутствует!';
	$warn1 = 'Программист: Создать файл robots.txt и разместить его на сайте!';
}else{
	$fileSize = remote_filesize($file);
	$content = fread($handle,$fileSize);
	setcookie('fileSize',$fileSize);
	setcookie('content',$content);
	$mess1 = 'файл robots.txt присутствует.';
	$warn1 = 'Доработки не требуются.';
	echo "<pre><a href='robots_read.php' 
                 target='_blank'>просмотр ROBOTS.TXT</a>"."\n";
}

echo "<a href='/index.php'>Вернуться к форме</a>"."\n";

$patternHost = "/^[^#]*host( )?:( )?/i";
if (preg_match_all($patternHost,$content,$matches,PREG_SET_ORDER)){
	$mess2 = 'Директива HOST указана.';
	$warn2 = 'Доработки не требуются.';
}else{
	$mess2 = 'В файле robots.txt не указана директива Host!';
	$warn2 = 'Программист: Для того, чтобы поисковые системы знали, какая версия 
	сайта является основных зеркалом, необходимо прописать адрес основного зеркала 
	в директиве Host. В данный момент это не прописано. Необходимо добавить в файл
	robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех 
	правил!';
}

$hostCount = count($matches);
if($hostCount != 1){
	$mess3="В файле прописано {$hostCount} директив Host!";
	$warn3='Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, 
	 корректную и соответствующую основному зеркалу сайта!';
}else{
	$mess3='В файле прописана 1 директива Host.';
	$warn3='Доработки не требуются.';
}

$fileSizeKb = $fileSize / 1000;

if($fileSizeKb <= 32){
	$mess4="Размер файла robots.txt составляет {$fileSizeKb} кб, что находится в пределах допустимой нормы.";
	$warn4='Доработки не требуются.';
}else{
	$mess4="Размер файла robots.txt составляет {$fileSizeKb} кб, что превышает допустимую норму!";
	$warn4='Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб';
}

$patternSitemap = "/^[^#]*sitemap( )?:( )?/i";
if (preg_match_all($patternSitemap,$content,$matches,PREG_SET_ORDER)){
	$mess5 = 'Директива Sitemap указана.';
	$warn5 = 'Доработки не требуются.';
}else{
	$mess5='В файле robots.txt не указана директива Sitemap';
	$warn5='Программист: Добавить в файл robots.txt директиву Sitemap';
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
		<tr>
			<td><?php echo $mess3 ?></td>
			<td><?php echo $warn3 ?></td>
		</tr>
		<tr>
			<td><?php echo $mess4 ?></td>
			<td><?php echo $warn4 ?></td>
		</tr>
		<tr>
			<td><?php echo $mess5 ?></td>
			<td><?php echo $warn5 ?></td>
		</tr>
	</tbody>
</table>

</pre>
	