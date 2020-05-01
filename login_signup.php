<!-- BOOTSTRAP CODE START -->

<?php
	session_start();
	if (isset($_SESSION['username'])) {
		echo "<script>
			alert('You are already logged in.');
			window.location.href='HomePage.php';
			</script>";
	}
 ?>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sign Up / Login</title>

</head>

<body>

  <h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-upper text-primary mb-3">Online Food Store</span>
  </h1>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="HomePage.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="Products.php">Products</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="cart.php">Cart</a>
          </li>
		  <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="profile.php">Profile</a>
          </li>
          <li class="nav-item active px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="login_signup.php">Sign Up / Login</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="Logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="page-section clearfix">
    <div class="container-cart">
      <div class="intro">
        <div class="text-center bg-faded p-5 rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-lower">Sign Up</span>
          </h2>
		  <h1> Create an account! </h1>
		  <form action = "signup.php" method = "post">
			  Username:
	  		<input type ="text" name = "username" /> <br><br>
			  Password:
	  		<input type = "password" name = "password" /> <br><br>
			<div class = "re-enter">
			  Re-enter Password:
			  <input type = "password" name = "repassword" /><br><br>
		  </div>
	  		<input type = "submit" name = "submit-signup" />
	  	</form>
         <hr>
		 <h2 class="section-heading mb-4">
			 <span class="section-heading-lower">Login</span>
		 </h2>
		 <h1> Sign in to your account! </h1>
		 <form action = "signup.php" method = "post">
			 Username:
		   <input type ="text" name = "username" /> <br><br>
			 Password:
		   <input type = "password" name = "password" /> <br><br>
		   <input type = "submit" name = "submit-login" />
	   </form>
        </div> <!-- this div ends the white box, add it at the end of the cart -->
      </div>
    </div>
  </section>
</body>

</html>

<!-- BOOTSTRAP CODE END -->