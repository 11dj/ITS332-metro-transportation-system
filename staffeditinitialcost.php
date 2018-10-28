<?php
	require_once('connectdb.php');
	session_start();
	if(!isset($_SESSION['timeout']) | !isset($_SESSION['staffusername']))
	{
    header('Location: staffloginform.php?error=4');
    exit;
	}
	else
	{
    if($_SESSION['timeout'] + 30 * 60 < time()){
        header('Location: staffloginform.php?error=2');
    }
    else{
        $_SESSION['timeout']=time();
    }
    $staffusername=$_SESSION['staffusername'];
}
?>




<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MetroSkytrain  | Administration</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini layout-boxed">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="staffmainmenu.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>ST</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Metro</b>Skytrain</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">


                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
				  <?php
					$q = "select StaffFullName from Staff where StaffUserName='$staffusername'";
					$result = $mysqli->query($q);
					while($row = $result->fetch_array()){
						echo ' '.$row['StaffFullName'];
					}
					?>

				  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">

                    <p>
                      <?php
					$q = "select StaffFullName from Staff where StaffUserName='$staffusername'";
					$result = $mysqli->query($q);
					while($row = $result->fetch_array()){
						echo ' '.$row['StaffFullName'];
					}
					?> 
                    </p>
					<p>
                      Username :  <?=$_SESSION['staffusername']?>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">

                    <div class="pull-right">
                      <a href="stafflogout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">



          <!-- search form (Optional) -->
          <!-- -->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
			
			
			
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview"><a href="staffmainmenu.php"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
			
			
			
						
			
            	
			<li class="treeview">
              <a href="#"><i class="fa fa-map-pin"></i> <span>Station</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="staffaddstation.php">Add New Station</a></li>
                <li><a href="staffvieweditdeletestationbtsormrt.php">View/Edit/Delete Station </a></li>
              </ul>
            </li>
			
			<li class="treeview">
              <a href="#"><i class="fa fa-exchange"></i> <span>Route&Schedule</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="staffaddrouteandschedule.php">Add New Route&Schedule</a></li>
                <li><a href="staffviewdeleterouteandschedule.php">View/Edit/Delete Route&Schedule</a></li>
              </ul>
            </li>
			
			<li class="treeview">
              <a href="#"><i class="fa fa-user"></i> <span>Member Passenger</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="staffaddmemberpassenger.php">Add New Member</a></li>
                <li><a href="staffeditmemberpassenger.php">Edit Member Passenger</a></li>
              </ul>
            </li>
			
			<li class="active"><a href="staffeditinitialcost.php"><i class="fa fa-link"></i> <span>Edit Initial Cost</span></a></li>
			
			<li><a href="staffeditpassengertypediscountrate.php"><i class="fa fa-link"></i> <span>Edit Passenger Type<br/>Discount Rate</span></a></li>
			
			<li><a href="staffviewtriprecord.php"><i class="fa fa-link"></i> <span>View Trip Record </span></a></li>
			
			
			
			
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Initial cost

          </h1>

        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
		  <!-- Info boxes -->
          
		  
		  <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Initial cost</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				

					<?php
						if(isset($_GET['feedback'])){
							if($_GET['feedback']==1){?>
								<h4>Updated InitialCostValue</h4>
					<?php     }
						} 

					?>
				

				
                  <form role="form" action="processeditinitialcost.php" method="get">
                   
				   
				   

                    <!-- select -->

					
					
                    <div class="form-group">
					<?php
						$q="select * from initialcost";
						$result=$mysqli->query($q);
						$row=$result->fetch_array();
						?>
						<?=$row['Description']?> : <input type="text" name="BTS" value="<?=$row['InitialCostValue']?>"><br>
						<?php $row=$result->fetch_array(); ?>
						<?=$row['Description']?> : <input type="text" name="MRT" value="<?=$row['InitialCostValue']?>"><br>
                    </div>

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
					</div>

                  </form>
                </div><!-- /.box-body -->
		  
		  
		  
		  
		  
		  
            
			
			
			
			
			
			
			
		  

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          ITS322 CPE Group17
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">ITS322 : Database system</a>.</strong> All rights reserved.
      </footer>

  

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
