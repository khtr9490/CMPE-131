<?php
	session_start();

	foreach ($_SESSION['products'] as $x => $x_value) {
		$_SESSION['products'][$x] = 0;
	}
	echo "<script>
		window.location.href='Cart.php';
		</script>
	";
 ?>