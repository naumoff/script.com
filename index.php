<?php
$url = '';
$errUrl = '';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
	if (empty($_POST['url']))
	{
		$errUlr = "* Please input URL";
	}else{
		$url = validate($_POST['url']);
	}
}

function validate($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>


<h3>checking lists</h3>
<form method="POST"
      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<fieldset>
		<legend>check robots.txt file</legend>
		Please input WEB address<br>
		<input type="url" name = "url" placeholder="http://google.com" required>
		
		<input type='submit' name = 'send' value='run' required>
	</fieldset>
</form>

<pre>

<?php

$file = $url.'/robots.txt';
echo $file."\n";

$handle = fopen($file,'r');
if (!$handle) {
	echo "File robots.txt is missing.\n";
	exit;
}else{
	echo 'Robots.txt successfully opened';
}


//if(!$handle) {
//	echo "unable to open robots.txt";
//}else{
//	echo "SUCCESS";
//	$content = fread($handle,filesize($url));
//	print_r($content);
//	fclose($handle);
//}


?>
</pre>