<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/header.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/open-iconic-bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/hover.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick-theme.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
     

        <!-- Title -->
        <title> Moviefy Home Theatre </title>

    </head>

    <body>

     <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>q
          </button>
          <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/img/logo3.png"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="<?php echo base_url();?>about"><span class="glyphicon glyphicon-info-sign"></span> About us</a></li>
            <li><a href="<?php echo base_url();?>movies"><span class="glyphicon glyphicon-film"></span> Movies</a></li>
            <!--<li><a href="<?php echo base_url();?>rooms"><span class="glyphicon glyphicon-home"></span> Rooms</a></li>-->
            <?php if($this->session->userdata('logged_in')): ?>
               <li><a href="<?php echo base_url();?>reservation_view"><span class="glyphicon glyphicon-list"></span> Reservation View</a></li>
             <?php endif;?>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <?php if($this->session->userdata('logged_in')):?>

                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('name'); ?>  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url();?>profile">Profile</a></li>
                      <li><a href="<?php echo base_url();?>logout">Logout</a></li>
                    </ul>
                </li>
                  <!-- <li><a href="<?php echo base_url();?>logout" ><span class="glyphicon glyphicon-log-out"></span> </a></li> -->
              <?php else: ?>
                   <li><a href="<?php echo base_url();?>login" ><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              <?php endif;?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Scripts -->
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script> 
       
    </script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/scrollreveal.min.js"></script>


    <script>
        $(document).ready(function(){

           $(window).on("scroll", function() {
            if($(window).scrollTop() > 20) {
                $(".navbar-inverse").addClass("active");
               // window.alert('Scrolled!');
            } else {
                //remove the background property so it comes transparent again (defined in your css)
               $(".navbar-inverse").removeClass("active");
            }
            });
        });
    </script>
    </body>

</html>
