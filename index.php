<?php
session_start(); //Connects Database
include "dbconnect.php";

if (isset($_GET['Message'])) { //Alert message
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit'])) //User login form
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysql_error());
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];//Dialog alert box that confirms sign in or user credentials that is wrong
             print'
                <script type="text/javascript"> alert("Successfully logged in!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript"> alert("Incorrect Username Or Password!");</script>
                  ';
        }
  }
  else if($_POST['submit']=="register") //User registration forms
  {
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysql_error);
        if(mysqli_num_rows($result)>0)
        {   
               print'
               <script type="text/javascript"> alert("Username is taken!");</script>
                    ';

        }
        else
        {
          $query ="INSERT INTO users VALUES ('$username','$password')";
          $result=mysqli_query($con,$query);
          print'
                <script type="text/javascript">
                 alert("Successfully Registered!");
                </script>
               ';
        }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="funko pops">
    <meta name="author" content="Zintle Mfobo">
    <title> Funko World </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        /* Styles and Media queries */
      .modal-header {background:#000000;color:#fff;font-weight:800;}
      .modal-body{font-weight:800;}
      .modal-body ul{list-style:none;}
      .modal .btn {background:#D67B22;color:#fff;}
      .modal a{color:#002244;}
      .modal-backdrop {position:inherit !important;}
       #login_button,#register_button{background:none;color:#fff!important;}       
       #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#002244;color:#fff;border-color:#002244;border-radius:2px;}
        .navbar-brand1{position: inherit;}
  	@media(max-width:767px){
        #query_button {padding: 5px 20px;}
        #books {margin-bottom: 50px;}
    @media only screen and (width: 768px) { body{margin-top:150px;}}
        #books .row{margin-top:30px;margin-bottom:30px;font-weight:800;}
    @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
  	}
    </style>
</head>
<body>

    <!-- Navbar -->
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid" style="background:#002244;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only"> Toggle navigation </span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" style="color:#fff;"> Funko World </a> 
          <a class="navbar-brand" href="about.php" style="color:#fff; margin-left: 350px;"> About Us  </a> 
          <a class="navbar-brand" href="result.php" style="color:#fff; margin-left: 350px;"> Our Collection  </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right">
        <?php
        if(!isset($_SESSION['user'])) //User login and registration
          {
            echo'
            <li>
                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login"> Login </button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center"> Login Form </h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                              <div class="form-group">
                                                  <label class="sr-only" for="username"> Username </label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password"> Password </label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block" style="background:#002244;">
                                                      Sign in
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register"> Sign Up </button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center"> Member Registration Form </h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="username"> Username </label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password"> Password </label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block" style="background:#002244;">
                                                    Sign Up
                                                </button>
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                          </div>
                      </div>
                  </div>
                </div>
            </li>';
          } 
        else
          {   echo' <li> <a href="#" class="btn btn-lg"> Hello ' .$_SESSION['user']. '.</a></li>
                    <li> <a href="cart.php" class="btn btn-lg"> Cart </a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg"> LogOut </a> </li>';
               
          }
?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <!-- Search bar -->
  <div id="top" > 
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;background:#002244;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Funko Pop or Category">
              </form>
          </div>
      </div>

      <!-- Left hand side of website -->
      <div class="container-fluid" id="header">
          <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                  <div style="background:#000000;color:#fff;font-weight:800;border:none;padding:15px;"> Funko Pop Collection </div>
                  <ul>
                      <li> <a href="Product.php?value=Justice%20League"> Justice League </a> </li>
                      <li> <a href="Product.php?value=Doom%20and%20Patrol"> Doom Patrol </a> </li>
                      <li> <a href="Product.php?value=Avengers"> Avengers </a> </li>
                      <li> <a href="Product.php?value=X-Men"> X-Men </a> </li>
                      <li> <a href="Product.php?value=Disney%20Princesses"> Disney Princesses </a> </li>
                      <li> <a href="Product.php?value=Disney%20Villains"> Disney Villains </a> </li>

                  </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          <li data-target="#myCarousel" data-slide-to="4"></li>
                      </ol>
                      
                        <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img class="img-responsive" src="img/carousel/1a.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive "src="img/carousel/2a.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/1.png">
                          </div>

                          <div class="item">
                            <img class="img-responsive"src="img/carousel/4.png">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/5a.jpg">
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Right hand side offers -->
              <div class="col-md-3 col-lg-3" id="offer">
                  <a href="Product.php?value=Regional%20Books">              <img class="img-responsive center-block" src="img/offers/1.png"></a>
                  <a href="Product.php?value=Health%20and%20Cooking">        <img class="img-responsive center-block" src="img/offers/2.png"></a>
                  <a href="Product.php?value=Academic%20and%20Professional"> <img class="img-responsive center-block" src="img/offers/3.png"></a>
              </div>
          </div>
      </div>
  </div>

  <!-- New funko pops -->
  <div class="container-fluid text-center" id="new">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-1&category=new">
              <div class="book-block">
                  <div class="tag"> New </div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/new/1.jpg">
                  <hr>
                  Like A Love Song <br>
                  R 113  &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> R 175 </span>
                  <span class="label label-warning">35%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-2&category=new">
              <div class="book-block">
                  <div class="tag"> New </div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/2.jpg">
                  <hr>
                  General Knowledge 2017  <br>
                  R 68 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> R 120 </span>
                  <span class="label label-warning">43%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-3&category=new">
              <div class="book-block">
                  <div class="tag"> New </div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/3.png">
                  <hr>
                  Indian Family Bussiness Mantras <br>
                  R 400 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> R 595 </span>
                  <span class="label label-warning">33%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-4&category=new">
              <div class="book-block">
                  <div class="tag"> New </div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/4.jpg">
                  <hr>
                  Kiran s SSC Mathematics Chapterwise Solutions <br>
                  R 289 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> R 435 </span>
                  <span class="label label-warning">33%</span>
              </div>
            </a>
          </div>
      </div>
  </div>

  <!-- Contact us Information -->
  <footer style="margin-left:-6%;margin-right:-6%;background:#002244;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-1 col-md-1 col-lg-1">
              </div>
              <div class="col-sm-7 col-md-5 col-lg-5">
                  <div class="row text-center" style="color:#fff;">
                      <h2> Contact Us!</h2>
                      <hr class="primary">
                      <p> Call or email us to find out more!</p>
                  </div>
                  <div class="row">
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-earphone" ></span>
                          <p style="color:#fff;"> 011 661 1116 </p>
                      </div>
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-envelope" ></span>
                          <p style="color:#fff;"> funkoworld27@gmail.com </p>
                      </div>
                  </div>
              </div>
              <div class="hidden-sm-down col-md-2 col-lg-2">
              </div>
              <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                  <h2 style="color:#fff;"> Follow Us: </h2>
                  <div>
                      <a href="https://twitter.com/">
                      <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="35" height="35" />
                      </a>
                      <a href="https://www.linkedin.com/">
                      <img title="LinkedIn" alt="LinkedIn" src="img/social/linkedin.png" width="35" height="35" />
                      </a>
                      <a href="https://www.facebook.com/">
                      <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
                      </a>
                      <a href="https://za.pinterest.com">
                      <img title="Pinterest" alt="Pinterest" src="img/social/pinterest.jpg" width="35" height="35" />
                      </a>
                  </div>
              </div>
          </div>
      </div>

      <!--Ferndale On Republic Iframe map embedded -->
	<div class="row text-center">
    <div class="col-sm-4 col-md-3 col-lg-3">
        <h2 style="color:#fff;margin-left:-6%;margin-right:-6%;"> Store Location: </h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3582.986799462278!2d27.988369715027744!3d-26.099349583484646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e9574c1a4b5a815%3A0x86f6aec51c98c295!2sFerndale%20On%20Republic!5e0!3m2!1sen!2sza!4v1670822846463!5m2!1sen!2sza" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  
    </footer>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" id="query_button" class="btn btn-lg" data-toggle="modal" data-target="#query" style="background:#002244;"> Ask query </button>
  <!-- Query modal -->
  <div class="modal fade" id="query" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="background:#000000;"> Ask your query here </h4>
          </div>
          <div class="modal-body">           
                    <form method="post" action="query.php" class="form" role="form">
                        <div class="form-group">
                             <label class="sr-only" for="name"> Name </label>
                             <input type="text" class="form-control"  placeholder="Your Name" name="sender" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="email"> Email </label>
                             <input type="email" class="form-control" placeholder="abc@gmail.com" name="senderEmail" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="query"> Message </label>
                             <textarea class="form-control" rows="5" cols="30" name="message" placeholder="Your Query" required></textarea>
                        </div>
                        <div class="form-group">
                              <button type="submit" name="submit" value="query" class="btn btn-block" style="background:#002244;">
                                                              Send Query
                               </button>
                        </div>
                    </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
          </div>
      </div>
    </div>  
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	
<!-- End of page -->