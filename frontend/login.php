<!DOCTYPE html>
<?php
  session_start();
  include("db.php");
  ?>
<html>
<head>
    <title>Food Store </title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="header";>
    <div class="inner_header";>
       <div class="hamburger_button">
         <img src="../img/menu-white.svg">
        </div>

       <div class="logo_container">
         <a href="index.php"><span>FOOD</span>MART</a>
        </div>

       <div class="search_bar">
         <input type="text" placeholder="Search..">
        </div>

       <ul class="navigation">
       <a href="login.php"><li>LOGIN/REGISTER</li></a>
          <a href="cart.php"><li>CART</li></a>
        </ul>
    </div>
  </div>
  <div class="login_content">
      <div class="inner_login_content">
          <div class="login_tile">
              <div class="login_title">
                <u1 class="list">
                  <form action="authenticate.php" method="post">
                    <li>Customer Login</li>
                    <li><input type="username" id="username" name="username" placeholder="User Name"></li>
                    <li><input type="password" id="password" name="password" placeholder="......"></li>
                    <li><input type="submit" name="Submit" value="Submit"></li>
                  </form>
                </u1>
              </div>
          </div>
      <div class="register_tile">

            <div class="login_title">
              <u1 class="list">
                <form action="adduser.php" method="post"
                  <li>Register</li>
                  <li><input type="user_name" id="user_name" name="user_name" placeholder="User Name"></li>
                  <li><input type="first_name" id="first_name" name="first_name" placeholder="First Name"></li>
                  <li><input type="last_name" id="last_name" name="last_name" placeholder="Last Name"></li>
                  <li><input type="email" id="email" name="email" placeholder="Email"></li>
                  <li><input type="password" id="password" name="password" placeholder="Password"></li>
                  <li><input type="phone" id="phone" name="phone" placeholder="Phone Number"></li>
                  <li><input type="city" id="city" name="city" placeholder="City"></li>
                  <li><input type="country" id="country" name="country" placeholder="Country"></li>
                  <li><input type="submit" name="submit" value="Register"></li>
                </form>
              </u1>
            </div>
          
        </div>
      </div>
  </div>








  <div class="footer";>
    <div class="inner_footer";>
      <a>123 Main Street San Jose, CA • 408-111-2345 • OnlineFoodStore@me.com</a>
    </div>
  </div>
</body>
