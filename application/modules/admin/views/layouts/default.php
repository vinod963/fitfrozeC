<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php echo $title_for_layout ?></title>	
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		
		<?php echo @$this->layouts->print_includes()['css']; ?> 
				
	</head>
	<body class="skin-blue sidebar-mini"> 
		<div class="wrapper">  
			  <!-- Main Header -->
			  <header class="main-header">		    
			    <!-- Logo --> 
			    <a href="http://www.bookit-now.co.uk/admin/index" class="logo"> 			    
			    <span class="logo-lg"><b>Bookit</b></span> </a> 			    
			    <!-- Header Navbar -->
			    <nav class="navbar navbar-static-top" role="navigation"> 
			      <!-- Sidebar toggle button--> 
			      <a href="http://www.bookit-now.co.uk/admin/index#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
			      <!-- Navbar Right Menu -->
			      <div class="navbar-custom-menu">
			        <ul class="nav navbar-nav">
			         
			       
			          <!-- User Account Menu -->
			          <li class="dropdown user user-menu"> 
			            <!-- Menu Toggle Button --> 
			            <a href="http://www.bookit-now.co.uk/admin/index#" class="dropdown-toggle" data-toggle="dropdown"> 
			            <!-- The user image in the navbar--> 
			            <img src="/images/user.png" class="user-image" alt="User Image"> 
			            <!-- hidden-xs hides the username on small devices so only the image appears. --> 
			            <span class="hidden-xs">Vinod kumar</span> </a>
			            <ul class="dropdown-menu">
			              <!-- The user image in the menu -->
			              <li class="user-header"> <img src="/images/user.png" class="img-circle" alt="User Image">
			                <p> Vinod kumar <!-- <small>Member since Nov. 2012</small> --> </p>
			              </li>
			             
			              <li class="user-footer">
			                <div class="pull-left"> <a href="http://www.bookit-now.co.uk/admin/profile" class="btn btn-default btn-flat">Profile</a> </div>
			                <div class="pull-right"> <a href="http://www.bookit-now.co.uk/admin/logout" class="btn btn-default btn-flat">Sign out</a> </div>
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
			      
			      <!-- Sidebar user panel (optional) -->
			      <div class="user-panel">
			        <div class="pull-left image"> <img src="/images/user.png" class="img-circle" alt="User Image"> </div>
			        <div class="pull-left info">
			          <p>Vinod kumar</p>
			          <!-- Status --> 
			          <a href="http://www.bookit-now.co.uk/admin/index#"><i class="fa fa-circle text-success"></i> Online</a> </div>
			      </div>
			      
			      <!-- search form (Optional) -->
			      <form action="http://www.bookit-now.co.uk/admin/index#" method="get" class="sidebar-form">
			        <div class="input-group">
			          <input type="text" name="q" class="form-control" placeholder="Search...">
			          <span class="input-group-btn">
			          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			          </span> </div>
			      </form>
			      <!-- /.search form --> 
			      
			      <!-- Sidebar Menu -->
			      <ul class="sidebar-menu">
			        <!-- Optionally, you can add icons to the links -->
        			   <li class="active"><a href="http://www.bookit-now.co.uk/admin/index"><i class="fa fa-table"></i> <span>Dashboard</span></a></li>
        			   <li class=""><a href="http://www.bookit-now.co.uk/admin/clearCache"><i class="fa fa-table"></i> <span>Clear Cache</span></a></li>		     
        			   <li class=""><a href="http://www.bookit-now.co.uk/admin/csvList"> <i class="fa fa-list"></i> <span>Manager Choices</span></a></li>
        			   <li class=""> <a href="http://www.bookit-now.co.uk/admin/mang_ext_categories"><i class="fa fa-list"></i> <span>Extras View</span></a> </li>    				        
                  </ul>
			      <!-- /.sidebar-menu --> 
			    </section>
			    <!-- /.sidebar --> 
			  </aside>
			  
			  <!-- Content Wrapper. Contains page content -->
			  <div class="content-wrapper" style="min-height: 738px;">  
			  		 <!-- Content Header (Page header) -->  
					<?php echo $content_for_layout; ?>
					<!-- /.content --> 
			  </div>
			  <!-- /.content-wrapper --> 
			  
			  <!-- Main Footer -->
			  <footer class="main-footer"> 
			    <!-- To the right --> 
			    
			    <!-- Default to the left --> 
			    <strong>Copyright 2016 <a href="#">Fitfroze</a>.</strong> All rights reserved. </footer>
			 
			</div>			  
		<?php echo @$this->layouts->print_includes()['js']; ?> 
	</body>
</html>