<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="assets/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="assets/assets/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!--aos.css -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/assets/build/css/custom.min.css" rel="stylesheet">
  </head>
  <style type="text/css">
    body{
      background-image: linear-gradient(115deg, #0be0d6 10%,#e00bc0 90%);
      height: 100vh;
      width: 100%;
      font-family: 'Poppins', sans-serif;
       
    }
  </style>

  <body>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              
            <form method="POST" action="query.php">
              <h1 style="color:white">Login Form</h1>
              <div>
                <input type="hidden" name="status" value="login">
                <input type="text" class="form-control" placeholder="Username" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name = "password" required="" id="myInput" />
                <input type="checkbox" onclick="myFunction()">Show Password
              </div>
              <div>
                <button type="submit" class="btn btn-blue text-center">Login</button>
                <a class="reset_pass" href="#" style="color:white">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link" style="color:white">New to site?
                  <a href="#signup" class="to_register" style="color:white"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1 style="color:white"><i class="fa fa-paw" style="color:white"></i > Gentelella Alela!</h1>
                  <p style="color:white">©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST" action="query.php">
              <input type="hidden" name="status" value="create_a/c">
              <h1 style="color:white">Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Name" name="name" required="" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="username" name="username" required="" />
              </div> 
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-blue text-center" style="color:white">Sign in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link" style="color:white">Already a member ?
                  <a href="#signin" class="to_register" style="color:white"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1 style="color:white"><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p style="color:white">©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  AOS.init();
  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
