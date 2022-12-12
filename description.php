<?php
session_start();
if(!isset($_SESSION['user']))
       header("location: index.php?Message=Please login To continue!"); //Window dialog that states you have to login to continue
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Funko Pops">
    <meta name="author" content="Zintle Mfobo">
    <title> Description </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    <style>  
    /* Styles and Media Queries to make Site responsive */
        @media only screen and (width: 768px) { body{margin-top:150px;}}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
        .tag {display:inline;float:left;padding:2px 5px;width:auto;background:#F5A623;color:#fff;height:23px;}
        .tag-side{display:inline;float:left;}
        #books {border:1px solid #DEEAEE; margin-bottom:20px;padding-top:30px;padding-bottom:20px;background:#fff; margin-left:10%;margin-right:10%;}
        #description {border:1px solid #DEEAEE; margin-bottom:20px;padding:20px 50px;background:#fff;margin-left:10%;margin-right:10%;}
        #description hr{margin:auto;}
        #service{background:#fff;padding:20px 10px;width:112%;margin-left:-6%;margin-right:-6%;}
        .glyphicon {color:#D67B22;}
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
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <?php
                  if(isset($_SESSION['user']))
                    {
                      echo'
                    <li><a href="cart.php" class="btn btn-md"> <span class="glyphicon glyphicon-shopping-cart" style="color:#fff;"> Cart </span></a></li>
                    <li><a href="destroy.php" class="btn btn-md"> <span class="glyphicon glyphicon-log-out"  style="color:#fff;"> LogOut </span></a></li>
                         ';
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
                <form role="search" action="Result.php" method="post">
                    <input type="text" name="keyword" class="form-control" placeholder="Search for a Funko Pop Or Category" style="width:80%;margin:20px 10% 20px 10%;">
                </form>
            </div>
        </div>
   </div>


    <?php
    include "dbconnect.php"; //Connects database
    $PID=$_GET['ID'];
    $query = "SELECT * FROM products WHERE PID='$PID'";
    $result = mysqli_query ($con,$query)or die(mysql_error());

        if(mysqli_num_rows($result) > 0) 
        {   
            while($row = mysqli_fetch_assoc($result)) //Shows discounted funko pops and books that are on sale to purchase
            {
            $path="images/funkos/".$row['PID'].".jpg" ".png" ".webp";
            $target="cart.php?ID=".$PID."&";
echo '
  <div class="container-fluid" id="funkos">
    <div class="row">
      <div class="col-sm-10 col-md-6">
                          <div class="tag">'.$row["Discount"].'%OFF</div>
                              <div class="tag-side"><img src="images/orange-flag.png">
                          </div>
                         <img class="center-block img-responsive" src="'.$path.'" height="550px" style="padding:20px;">
      </div>
      <div class="col-sm-10 col-md-4 col-md-offset-1">
        <h2> '. $row["Title"] . '</h2>
                                <span style="color:#00B9F5;">
                                 #'.$row["Category"].'&nbsp.'
                                </span>
        <hr>            
                                <span style="font-weight:bold;"> Quantity : </span>';
                                echo'<select id="quantity">';
                                   for($i=1;$i<=$row['Available'];$i++)
                                       echo '<option value="'.$i.'">'.$i.'</option>';
                               echo ' </select>';
echo'                           <br><br><br>
                                <a id="buyLink" href="'.$target.'" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
                                    ADD TO CART for R '.$row["Price"] .' <br>
                                    <span style="text-decoration:line-through;"> R'.$row["MRP"].'</span> 
                                    | '.$row["Discount"].'% discount
                                 </a> 

      </div>
    </div>
          </div>
     ';
echo '
          <div class="container-fluid" id="description">
    <div class="row">
      <h2> Description </h2> 
                        <p>'.$row['Description'] .'</p>
                        <pre style="background:inherit;border:none;">
   PRODUCT CODE  '.$row["PID"].'   <hr> 
   TITLE         '.$row["Title"].' <hr> 
   CATEGORY        '.$row["Category"].' <hr>
   AVAILABLE     '.$row["Available"].' <hr> 
                        </pre>
    </div>
  </div>
';

            
            }
        }
    echo '</div>';
    ?>


<!-- Footer to insure 24/hr care to customers -->
<div class="container-fluid" id="service">
      <div class="row">
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-heart"></span> <br>
               Contact Us <br>
               Always happy to help, call us on 011 575 6213 or click here!
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-ok"></span> <br>
               Reliable <br>
               Refunds and returns available subject to terms and connditions.
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-check"></span> <br>
               Assurance <br>
               We provide 100% assurance. If you have any issue, your money is immediately refunded. Sit back and enjoy your shopping!
          </div>
          <div class="col-sm-6 col-md-3 text-center">
               <span class="glyphicon glyphicon-tags"></span> <br>
               24hr Care <br>
               We always put our customers first!
          </div>
      </div>
</div>
 


    <!-- jQuery (necessary for Bootstrap JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<script>
            $(function () {
                var link = $('#buyLink').attr('href'); //Function to buy desired funko pop
                $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
                $('#quantity').on('change', function () {
                    $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
                });
            });
    </script>
</body>
</html>       
<!-- End of page -->