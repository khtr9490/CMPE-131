<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="styles/css/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input id="name" name="username" placeholder="" type="text" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input id="password" name="password" placeholder="" type="password" required>
				<input name="submit" type="submit" value=" Login ">
			</form>
		</div>
	</body>
</html>