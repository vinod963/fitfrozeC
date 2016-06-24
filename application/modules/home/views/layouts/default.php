<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
	<head>
		 <title><?php echo $title_for_layout ?></title>
		
		<!-- Theme files -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> -->
		<?php echo @$this->layouts->print_includes()['css']; ?> 	
		<!-- Custom Theme files -->
			
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />	
				
	</head>
	<body>
		<!-- header-section-starts -->
		<div class="container">	
			<div class="news-paper">
				<div class="header">
					<div class="header-left">
						<div class="logo">
							<a href="index.html">
								<h6>the</h6>
								<h1>News <span>Reporter</span></h1>
							</a>
						</div>
					</div>					
					<div class="clearfix"></div>
					<div class="header-right">
						<div class="top-menu">
							<ul>        
								<li><a href="index.html">Home</a></li> |  
								<li><a href="about.html">About Us</a></li> |   
								<li><a href="contact.html">Contact Us</a></li>  |   
								<li><a id="modal_trigger" href="#modal" class="btn1">Login</a>
									<div id="modal" class="popupContainer" style="display:none;">
										<header class="popupHeader">
											<span class="header_title">Login</span>
											<span class="modal_close"><i class="fa fa-times"></i></span>
										</header>
			
										<section class="popupBody">
											<!-- Social Login -->
											<div class="social_login">
												<div class="">
													<a href="#" class="social_box fb">
														<span class="icon"><i class="fa fa-facebook"></i></span>
														<span class="icon_title">Connect with Facebook</span>
														
													</a>
								
													<a href="#" class="social_box google">
														<span class="icon"><i class="fa fa-google-plus"></i></span>
														<span class="icon_title">Connect with Google</span>
													</a>
												</div>
								
												<div class="centeredText">
													<span>Or use your Email address</span>
												</div>
								
												<div class="action_btns">
													<div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
													<div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
												</div>
											</div>
								
											<!-- Username & Password Login form -->
											<div class="user_login">
												<form>
													<label>Email / Username</label>
													<input type="text" />
													<br />
								
													<label>Password</label>
													<input type="password" />
													<br />
								
													<div class="checkbox">
														<input id="remember" type="checkbox" />
														<label for="remember">Remember me on this computer</label>
													</div>
								
													<div class="action_btns">
														<div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
														<div class="one_half last"><a href="#" class="btn btn_red">Login</a></div>
													</div>
												</form>
								
												<a href="#" class="forgot_password">Forgot password?</a>
											</div>
								
											<!-- Register Form -->
											<div class="user_register">
												<form>
													<label>Full Name</label>
													<input type="text" />
													<br />
								
													<label>Email Address</label>
													<input type="email" />
													<br />
								
													<label>Password</label>
													<input type="password" />
													<br />
								
													<div class="checkbox">
														<input id="send_updates" type="checkbox" />
														<label for="send_updates">Send me occasional email updates</label>
													</div>
								
													<div class="action_btns">
														<div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
														<div class="one_half last"><a href="#" class="btn btn_red">Register</a></div>
													</div>
												</form>
											</div>
										</section>
									</div>
								</li> |   
								<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog1">Subscribe</a></li>
							</ul>
						</div>					
						<div id="small-dialog1" class="mfp-hide">
							<div class="signup">
								<h3>Subscribe</h3>
								<h4>Enter Your Valid E-mail</h4>
								<input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
								<div class="clearfix"></div>
								<input type="submit"  value="Subscribe Now"/>
							</div>
						</div>               
						<div class="search">
							<form>
								<input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"/>
								<input type="submit" value="">
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="menu-strip">
					<div id="navbar">    
					  <nav class="navbar navbar-default navbar-static-top" role="navigation">
					            <div class="navbar-header">
					                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
					                    <span class="sr-only">Toggle navigation</span>
					                    <span class="icon-bar"></span>
					                    <span class="icon-bar"></span>
					                    <span class="icon-bar"></span>
					                </button>					             
					            </div>
					            
					            <div class="collapse navbar-collapse" id="navbar-collapse-1">
					                <ul class="nav navbar-nav">
					                    <li class="active"><a href="#">Home</a></li>
					                    <li><a href="#">Coupons</a></li>
					                    <li><a href="#">My Story</a></li>
					                    <li><a href="#">Songs</a></li>
					                    <li class="dropdown">
					                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">News <b class="caret"></b></a> 
					                      
					                        <ul class="dropdown-menu">
					                          <li class=""><a href="#">Dropdown</a></li>
					                            <li><a href="#">Dropdown Link 1</a></li>
					                            <li class="active"><a href="#">Dropdown Link 2</a></li>
					                            <li><a href="#">Dropdown Link 3</a></li>
					                          
					                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 4</a>
					    							<ul class="dropdown-menu">
					                                    <li class="kopie"><a href="#">Dropdown Link 4</a></li>
														<li><a href="#">Dropdown Submenu Link 4.1</a></li>
														<li><a href="#">Dropdown Submenu Link 4.2</a></li>
														<li><a href="#">Dropdown Submenu Link 4.3</a></li>
														<li><a href="#">Dropdown Submenu Link 4.4</a></li>
					                                                                      
													</ul>
												</li>
					                          
					                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 5</a>
													<ul class="dropdown-menu">
					                                    <li class="kopie"><a href="#">Dropdown Link 5</a></li>
														<li><a href="#">Dropdown Submenu Link 5.1</a></li>
														<li><a href="#">Dropdown Submenu Link 5.2</a></li>
														<li><a href="#">Dropdown Submenu Link 5.3</a></li>
														
														<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
															<ul class="dropdown-menu">
					                                            <li class="kopie"><a href="#">Dropdown Submenu Link 5.4</a></li>
																<li><a href="#">Dropdown Submenu Link 5.4.1</a></li>
																<li><a href="#">Dropdown Submenu Link 5.4.2</a></li>
																
																
															</ul>
														</li>                           
													</ul>
												</li>                                   
					                        </ul>
					                    </li>
					                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Blah Blah <b class="caret"></b></a>
					                        <ul class="dropdown-menu">
					                            <li class=""><a href="#">Dropdown2</a></li>
					                            <li><a href="#">Dropdown2 Link 1</a></li>
					                            <li><a href="#">Dropdown2 Link 2</a></li>
					                            <li><a href="#">Dropdown2 Link 3</a></li>
					                            
					                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 Link 4</a>
													<ul class="dropdown-menu">
					                                    <li class="kopie"><a href="#">Dropdown2 Link 4</a></li>
														<li><a href="#">Dropdown2 Submenu Link 4.1</a></li>
														<li><a href="#">Dropdown2 Submenu Link 4.2</a></li>
														<li><a href="#">Dropdown2 Submenu Link 4.3</a></li>
														<li><a href="#">Dropdown2 Submenu Link 4.4</a></li>
					                                   
													</ul>
												</li>
					                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown2 Link 5</a>
													<ul class="dropdown-menu">
					                                    <li class="kopie"><a href="#">Dropdown Link 5</a></li>
														<li><a href="#">Dropdown2 Submenu Link 5.1</a></li>
														<li><a href="#">Dropdown2 Submenu Link 5.2</a></li>
														<li><a href="#">Dropdown2 Submenu Link 5.3</a></li>
														<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
															<ul class="dropdown-menu">
					                                            <li class="kopie"><a href="#">Dropdown2 Submenu Link 5.4</a></li>
																<li><a href="#">Dropdown2 Submenu Link 5.4.1</a></li>
																<li><a href="#">Dropdown2 Submenu Link 5.4.2</a></li>
																
															</ul>
														</li>                                  
													</ul>
												</li>                                  
					                        </ul>
					                    </li>
					                </ul>
					            </div><!-- /.navbar-collapse -->
					        </nav>
					</div>    
				</div>			
				<div class="clearfix"></div>
				<div class="main-content">	
					<?php echo $content_for_layout; ?> 
				</div>
			</div>
		</div>
	</body>
	<?php echo @$this->layouts->print_includes()['js']; ?> 
</html>