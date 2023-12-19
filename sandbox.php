<?php 
	// ternary operators
	$score = 50;
	// superglobals

	//$_GET['name'], $_POST['name']

						// echo $_SERVER['SERVER_NAME'] . '<br />';
						// echo $_SERVER['REQUEST_METHOD'] . '<br />';
						// echo $_SERVER['SCRIPT_FILENAME'] . '<br />';
						// echo $_SERVER['PHP_SELF'] . '<br />';

	if(isset($_POST['submit'])){

		//cookie for gender
		setcookie('gender', $_POST['gender'], time() + 86400); 
		// 84000 seconds in day


		session_start();

		$_SESSION['name'] = $_POST['name'];

		header('Location: index.php');
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Bawa Pizza</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="text" name="name">
		<select name="gender">
			<option value="male">male</option>
			<option value="female">female</option>
		</select>
		<!-- shows dropdown for gender select -->
		<input type="submit" name="submit" value="submit">
	</form>

	<!-- <h2><?php echo $score > 40 ? 'high score!' : 'low score!'; ?></h2> -->

</body>
</html>