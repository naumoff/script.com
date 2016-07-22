<form>
	
</form>

<?php
echo "Hello World";
?>

<?php
$web = 'www.brutalitet.com';
$file = fopen($web,'r');
IF(!$file){
	echo "mistake";
}else{
	echo "Success";
}
?>