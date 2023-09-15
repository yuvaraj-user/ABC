<?php
include("secure.php");

session_start();
require_once "srdb.php";
if ($_SESSION['username']) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['login'])) {
  $do_login = true;

  include_once 'do_login.php';
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Billing | Login</title>
  <meta name="author" content="">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="bootstrap/css/Font-Awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bootstrap/css/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck style="background: url(img1.jpg);
    background-size: 1360px 700px;
    background-repeat: no-repeat;"        -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <style>
    .login-box-msg {
      border-bottom: 1px solid #ddd;
      padding: 0px 0px 7px 0px;
      margin-bottom: 15px;
      color: #fff;
      font-size: 20px;
    }
  </style>
</head>

<body class="hold-transition login-page" style="background: url(img-bg1.jpg);     background: #e8e8e8;

    background-repeat: no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">

  <div class="row login-box">

    <div class="login-logo">
      <!-- <a href="index2.html"><b>Admin</b>LTE</a>-->
    </div><!-- /.login-logo -->
    <!-- start: LOGIN BOX -->
    <div id="box">
      <div class="box-login">
        <?php
        if (isset($_REQUEST['Info'])) {
          $readinfo = $_REQUEST['Info'];


          if (isset($_REQUEST['User'])) {
            $readsessuser = $_REQUEST['User'];
          }

          if ($readinfo == 'Invalid') {
        ?>
            <div class="alert alert-block alert-danger fade in">
              <button data-dismiss="alert" class="close" type="button">
                &times;
              </button>
              <h4 class="alert-heading"><i class="fa fa-times-circle"></i> Error !</h4>
              <p>
                Incorrect Username and/or Password. Try Again.
              </p>
              <!-- <p>
											<a href="#" class="btn btn-bricky">
												Take this action
											</a>
											<a href="#" class="btn btn-light-grey">
												Or do this
											</a>
										</p> -->
            </div>
          <?php
          }
          if ($readinfo == 'Login_First') {
          ?>
            <div class="alert alert-block alert-warning fade in">
              <button data-dismiss="alert" class="close" type="button">
                &times;
              </button>
              <h4 class="alert-heading"><i class="fa fa-warning"></i> Protected Page !</h4>
              <p>
                You are Trying to View a Protected Page, Which Requires Authentication. Kindly Login First.
              </p>
              <!-- <p>
											<a href="#" class="btn btn-bricky">
												Take this action
											</a>
											<a href="#" class="btn btn-light-grey">
												Or do this
											</a>
										</p> -->
            </div>
          <?php
          }

          if ($readinfo == 'Logged_Out') {

          ?>
            <div class="alert alert-block alert-info fade in">
              <button data-dismiss="alert" class="close" type="button">
                &times;
              </button>
              <h4 class="alert-heading"><i class="fa fa-sign-out"></i> Logged Out !</h4>
              <p>
                Hello, <?php echo $readsessuser; ?> ! You Have Been Logged Out Successfully.
              </p>
              <!-- <p>
											<a href="#" class="btn btn-bricky">
												Take this action
											</a>
											<a href="#" class="btn btn-light-grey">
												Or do this
											</a>
										</p> -->
            </div>
        <?php
          }
        }
        ?>

        <div class="login-box-body">
          <p class="login-box-msg">Login To Your Account</p>
          <img class="logo center-block" src="chitfund/images/gopuram.jpg" alt="" style="width:80%">
          <div id="msg" style="color:#228B22;"></div> </br>
          <form name="addloginform" method="post">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="username" placeholder="Username" id="username">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="on" id="password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>

                  </label>
                </div>
              </div><!-- /.col -->
              <div class="col-xs-8">

              </div>

              <div class="col-xs-4">
                <button type="submit" name="login" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div><!-- /.col -->
            </div>
          </form>

        </div><!-- /.login-box-body -->
      </div><!-- /.login-box -->
      <form name="forgotpswd1" id="forgotpswd1" method="post" enctype="multipart/form-data">
        <!--modal-->
        <div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">What's My Password?</h1>
              </div>
              <div class="modal-body">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="text-center">

                        <p>If you have forgotten your password you can reset it here.</p>
                        <div class="panel-body">
                          <fieldset>
                            <div class="form-group">
                              <input class="form-control input-lg" placeholder="E-mail Address" name="resetpasswordemail" id="resetpasswordemail" type="email">
                            </div>
                            <input type="button" class="btn btn-lg btn-primary btn-block" name="sendmypswd " id="sendmypswd" onclick="return getchit();" value="Send My Password">
                          </fieldset>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <div class="col-md-12">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="doc"></div>
      </form>

      <?php
      if (isset($_REQUEST['login'])) {
        $userid = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        # $newpassword=md5($password);

        $newpwd = hash('sha256', $password);

        $q = "select * from tbl_users where Email='$userid' and Password='$newpwd' and Status='Active'";
        $passq = mysqli_query($con, $q);
        $count = mysqli_num_rows($passq);

        $getsection = $_SESSION['Section'];

        if ($count > 0) {

          $getarr = mysqli_fetch_array($passq);
          $username = $getarr['Name'];
          $EmptblId = $getarr['Emp_tbl_Id'];

          $_SESSION['User'] = $username;
          $_SESSION['UserID'] = $userid;
          $_SESSION['UserEMPID'] = $EmptblId;
          $q = "select * from tbl_users where Email='$userid' and Status='Active'";
          $passq = mysqli_query($con, $q);
          $fetch = mysqli_fetch_array($passq);
          $_SESSION['permission'] = $fetch['Permission'];
          $_SESSION['usersessionid'] = $fetch['Id'];
          $_SESSION['levelstatus'] = $fetch['Level'];
          $_SESSION['employeesessionid'] = $fetch['Emp_tbl_Id'];
          $_SESSION['User_Level_Type'] = $fetch['Level_Type'];
          $permissions = substr_replace($permission, "", -1);
          $permissionlist = explode(',', $permissions);
          $level = $fetch['Level'];
          //$_SESSION['levelstatus']=$fetch['Level'];



          foreach ($permissionlist as $value) {
            echo $value . "<br>";
          }



          /*if($getsection=='marketing')
	{
		echo "<script>window.location='marketing/dashboard.php';</script>";
	}
	*/



          //echo "<script>window.location='chitfund/home.php';</script>";
          /*if($level==1)
{
echo "<script>window.location='chitfund/executedashboard.php';</script>";
}
else if($level==2)
{*/
          echo "<script>window.location='app/home.php';</script>";
          //}
        } else {
          echo "<script>window.location='index.php?Info=Invalid';</script>";
        }
      }
      ?>
      <!-- jQuery 2.1.4 -->
      <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- Bootstrap 3.3.5 -->
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <!-- iCheck -->
      <script src="plugins/iCheck/icheck.min.js"></script>
      <script>
        function getchit() {

          var resetpasswordemail = $("#resetpasswordemail").val();
          $.ajax({
            type: "POST",
            url: "check_forgotpassword.php",
            data: "resetpasswordemail=" + resetpasswordemail,
            success: function(data) {
              $("#msg").html(data);
              $("#pwdModal").hide();
              $(".modal-backdrop.in").fadeTo("slow", 0);

              $(".modal-backdrop").css({
                position: 'relative',
                top: 10,
                left: 10
              });

            }
          });
        }
      </script>
      <script>
        $(function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
          });

        });
      </script>
</body>

</html>
<script type="text/javascript">
  function noBack() {
    window.history.forward()

  }
  noBack();
  window.onload = noBack;
  window.onpageshow = function(evt) {
    if (evt.persisted) noBack()
  }
  window.onunload = function() {
    void(0)
  }
</script>
<?php
?>