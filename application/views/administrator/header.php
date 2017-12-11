<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">

        <!-- Styles -->

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fancybox.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/open-iconic-bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/material-icons.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/hover.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick-theme.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">


        <!-- Title -->
        <title> Moviefy Home Theatre </title>

    </head>

    <body>

     <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>admin"> <img src="<?php echo base_url();?>assets/img/logo.svg" width=100 alt=""></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
              <li><a href="<?php echo base_url();?>admin/accounts"><span class="oi oi-people"></span> Accounts</a></li>
                <li><a href="<?php echo base_url();?>admin/movies"><span class="glyphicon glyphicon-film"></span> Movies</a></li>
                 <li><a href="<?php echo base_url();?>admin/rooms"><span class="glyphicon glyphicon-th-large"></span> Rooms</a></li>
                  <li><a href="<?php echo base_url();?>admin/reservations"><span class="oi oi-layers"></span>  Reservations</a></li>
                   <li><a href="<?php echo base_url();?>admin/slideshows"><span class="glyphicon glyphicon-picture"></span> Slide shows</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo base_url();?>logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
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
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.min.js"></script>
    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/slick.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/scrollreveal.min.js"></script>
    
    <script>
        $(document).ready(function(){

        
        });
    </script>
    </body>

</html>
