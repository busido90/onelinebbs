<?php

$dsn = 'mysql:dbname=onelinebbs;host=localhost';
$user = 'root';
$password = 'camp2015';
$dbh =new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$errors = array();

if ($_SERVER['RQUEST_METHOD'] === 'POST') {
	$name = null;
	if (!isset($_POST['name']) || !strlen($_POST['name'])) {
		$errors['name'] = '名前を入力してください';
	 else if (strlen($_POST('name') > 40) {
		$errors['name'] = '名前は４０文字以上にしてください';	
	} else {
		$name = $_POST['name'];
	}

	$coment =null;
	if(!issset($POS['comment']) || !strlen($_POST['comment'])) {
		$errors['comment'] = 'ひとことを入力してください';
	} else if (strlen($_POST['comment']) > 200) {
		errors('comment') = 'ひとことは２００文字以内にしてください'
	} else {
		$comment = $_POST['comment'];
	}
		
	if (count($errors) === 0) {
	$sql = "INSERT INTO `post` (`name`, `comment` , `created_at`) VALUES ('"
	. mysql_real_escape_string($name) . "' , '"
	. mysql_real_escape_string($comment) . "' , '"
	. date('Y-m-d H:i:s' . "')";
	
	mysql_query($sql, $link);

	
	mysql_query($sql, $link);

	mysql_close($link);

	header('Location: http://' .$_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI']);
	}

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ひとこと掲示板</title>
<style>
</style>
<!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
	<h1>ひとこと掲示板</h1>

	<form action="bbs.php" method="post">
		<?php if (count($errors)): ?>
		<ul class="error_list">
			<?php foreach($errors as $error): ?>
			<li>
				<?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
			</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
		名前：　<input type="text" name="name" /><br />
		ひとこと：　<input type="text" name="comment" size="60" /><br />
		<input type="submit" name="submit" value="送信" />
	</form>

	<?php
	$sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";
	$result = mysql_query($sql, $link);
	?>

	<? if ($result !== false && mysql_num_ruws($result)): ?>
	<ul>
			<?php while ($post = mysql_fetch_assoc($result)): ?>
			<li>
				<?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>:
				<?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8'); ?>
				- <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?>
			</li>
		<?php endwhile; ?>
	</ul>
	<?php
	mysql_free_result($result);
	mysql_close($link);
	?>
</body>
</html>