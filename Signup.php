<html>
<head>
	<title>
		Sign Up
	</title>
</head>
<body>
<?php
	session_start();

	$username = "";
	$password = "";
	$_SESSION['username'] = ""; 
    $_SESSION['password'] = ""; 
    
	$conn = mysqli_connect("localhost", "root", "", "dbtest");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$_SESSION['conn'] = $conn;

	if (isset($_POST['submit-signup'])) {
	 	$username = $_POST['username'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		if (empty($username)) {
			echo "<script>
				alert('Please enter an username.');
				window.location.href='login_signup.php';
				</script>";
				exit;
		}
		else if (empty($password)) {
			echo "<script>
				alert('Please enter a password.');
				window.location.href='login_signup.php';
				</script>";
				exit;
		}
		else if (empty($repassword)) {
			echo "<script>
				alert('Please re-enter your password.');
				window.location.href='login_signup.php';
				</script>";
				exit;
		}
		if ($password != $repassword) {
			echo "<script>
				alert('The password does not match.');
				window.location.href='login_signup.php';
				</script>";
			exit;
		}
		else {
			$user_check_query = "SELECT * FROM uid WHERE username='$username' LIMIT 1";
	 		$result = mysqli_query($conn, $user_check_query);
	 		$user = mysqli_fetch_assoc($result);
			if ($user) {
				if ($user['username'] === $username) {
					echo "<script>
						alert('The username is already taken.');
						window.location.href='login_signup.php';
						</script>";
					exit;
				}
			}
			$sql = "INSERT INTO uid (username, password) VALUES ('$username', '$password')";
			$results = mysqli_query($conn, $sql);
			if ($results) {
				echo "<script>
					alert('Your account has been created. You can now login using your new credentials.');
					window.location.href='Products.php';
					</script>";
			} else {
				echo mysqli_error($conn);
			}
		}
	}

	if (isset($_POST['submit-login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username)) {
			echo "<script>
				alert('Please enter an username.');
				window.location.href='login_signup.php';
				</script>";
			exit;
		}
		else if (empty($password)) {
			echo "<script>
				alert('Please enter a password.');
				window.location.href='login_signup.php';
				</script>";
			exit;
		}
		$sql = "SELECT * FROM uid WHERE username='$username' AND password='$password'";
		$results = mysqli_query($conn, $sql);
	  	if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			echo "<script>
				alert('Successfully logged in.');
				</script>";
			header ('location: HomePage.php');
	  	} else {
			echo "<script>
				alert('The username/password does not match.');
				window.location.href='login_signup.php';
				</script>";
			exit;
	  	}
	}
 ?>
</body>
</html>