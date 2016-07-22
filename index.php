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

