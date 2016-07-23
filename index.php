<?php
$url = '';
$errUrl = '';

if ($_SERVER['REQUEST_METHOD']=='POST')
{
	if (empty($_POST['url']) || empty($_POST['send']))
	{
		$errUlr = "* Please input URL";
	}else{
		$url = validate($_POST['url']);
		setcookie('url',$url);
		header('Location: ./results/robots.php');
		exit;
	}
}

function validate($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title>robots.txt check</title>
	<meta charset="UTF-8">
</head>
<body>
<h3>Проверка</h3>
<form method="POST"
      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<fieldset>
		<legend>проверка файла robots.txt</legend>
		Пожалуйста укажите полный WEB адрес<br>
		<input type="url" name = "url" placeholder="http://google.com" required>
		<input type='submit' name = 'send' value='проверить' required>
	</fieldset>
</form>

<b><?php echo $errUlr; ?></b>
</body>
</html>



