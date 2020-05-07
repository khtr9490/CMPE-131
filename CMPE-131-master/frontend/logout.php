<html>

<head>
	
    <title>
		
        Logout
	
    </title>
    
</head>

<body>
	
    <?php
		session_start();
		$_SESSION['username'] = "";
		$_SESSION['password'] = "";
		session_destroy();
		echo "<script>
			alert('You are now logged out.');
			window.location.href='index.php';
			</script>";
		mysqli_close($conn);
	 ?>
     
</body>

</html>