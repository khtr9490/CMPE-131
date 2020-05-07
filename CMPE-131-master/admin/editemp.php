 <?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../emp-login.php');
	exit;
}
include("../db.php");
$admin_id=$_REQUEST['user_id'];

$result=mysqli_query($con,"select admin_id, admin_name, admin_password, admin_email from admin_info where admin_id='$admin_id'")or die ("query 1 incorrect.......");

list($admin_id,$admin_name,$admin_password, $admin_email)=mysqli_fetch_array($result);

if(isset($_POST['btn_save'])) 
{

$admin_name=$_POST['admin_name'];
$admin_email=$_POST['admin_email'];
$admin_password=$_POST['admin_password'];

mysqli_query($con,"update admin_info set admin_name='$admin_name', admin_email='$admin_email', admin_password='$admin_password' where admin_id='$admin_id'")or die("Query 2 is inncorrect..........");

header("location: manageemp.php");
mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        <div class="col-md-5 mx-auto">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Edit User</h5>
              </div>
              <form action="editemp.php" name="form" method="post" enctype="multipart/form-data">
              <div class="card-body">
                
                  <input type="hidden" name="user_id" id="admin_id" value="<?php echo $admin_id;?>" />
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="admin_name" name="admin_name"  class="form-control" value="<?php echo $admin_name; ?>" >
                      </div>
                    </div>
					<div class="col-md-12 ">
                      <div class="form-group">
                        <label >Password</label>
                        <input type="text" name="admin_password" id="admin_password" class="form-control" value="<?php echo $admin_password; ?>">
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email"  id="admin_email" name="admin_email" class="form-control" value="<?php echo $admin_email; ?>">
                      </div>
                    </div>
                  
                  
                  
                
              </div>
              <div class="card-footer">
                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update</button>
              </div>
              </form>    
            </div>
          </div>
         
          
        </div>
      </div>
      <?php
include "footer.php";
?>