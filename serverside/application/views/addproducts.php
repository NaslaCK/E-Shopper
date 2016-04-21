<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add Product | E-Shopper</title>
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/price-range.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/main.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo base_url();?>images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>images/ico/apple-touch-icon-57-precomposed.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <style type="text/css">
@media screen and (-webkit-min-device-pixel-ratio:0) {
    select {padding-right:18px}
}</style>
<script>
	function fun1()
{
	var vall=$('#cat1').val();
	$.ajax({
		'type' :"POST",
		'url' :"<?php echo base_url(); ?>"+"index.php/welcome/subcop",
		'datatype':"json",
		'data':{name:vall},
		'success':function(data){
			
			$('#hi').empty();
			
			var abc= JSON.parse(data);
				
				
			var toAppend='<option>select subcategory</option>';
			for (var i = 0 ; i <=abc.length-1; i++) {

				toAppend+="<option value='"+abc[i].pk_int_sub_id+"'>"+abc[i].vchr_sub_name+"</option>";
			};
			$('#hi').append(toAppend);
		}
		});
	

}
</script>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="<?php echo base_url();?>images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									INDIA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">India</a></li>
									<li><a href="#"></a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									RUPEES
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Indian Rupees</a></li>
									<li><a href="#"></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<li><a href="logout" ><i class="fa fa-lock"></i> Logout</a></li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="admin" >Home</a></li>
								<!-- <li><a href="aboutus">About Us</a></li> -->
								<li class="dropdown"><a href="#">Add<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="addcat">Category</a></li>
										<li><a href="selectcategory">Sub Category</a></li> 
										<li><a href="#" class="active">Products</a></li> 
                                    </ul>
                                </li> 
								
								
								<li class="dropdown"><a href="#">View<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="viewcategory">Category</a></li>
										<li><a href="viewsubcategory">Sub Category</a></li> 
										 
										<li><a href="viewprod">Products</a></li> 
                                    </ul></li>

                                    <li class="dropdown"><a href="#">Edit<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="editcat">Category</a></li>
										<li><a href="editsubcat">Sub Category</a></li> 
										 
										<li><a href="editproduct">Products</a></li> 
                                    </ul></li>

                                    <li class="dropdown"><a href="#">Customers<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Add Customer</a></li>
										<li><a href="viewcusto">View Customer</a></li> 
										 
										<li><a href="suspendcusto">Suspend</a></li> 
                                    </ul></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
								
	
	<section>
		<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Add <strong>Products</strong></h2>    			    				    				
					
				</div>			 		
			</div>
			<div class="row">  	
	    		<div class="col-sm-12">

				<div class="col-sm-offset-1 col-sm-10">
            				<div class="panel panel-default">
            				<div class="panel-body">

<form class="form-horizontal" role="form" name="" action ="insertpro" method="post" enctype="multipart/form-data">
 		<div class="form-group">
                        					<label  class="col-sm-4 control-label">Category Name</label>
                        					<div class="col-sm-7">
                        					<select id="cat1" name="cat1" onChange="fun1()"><option>Select Category</option><?php
												foreach ($category as $row) 
												{
													echo '<option value="'.$row->pk_int_cat_id.'">'.$row->vchr_cat_name.'</option>';
					 							} 

											?></select>
                        					</div>
                        					
										</div>

										<div class="form-group">
										<label  class="col-sm-4 control-label">Sub-Category Name</label>
										<div class="col-sm-7">
										<select id="hi" name="sel2">
                   						
                   						</select>
                   					</div>
                   				</div>
                   				<?php
                   				if(isset($error))
                                     echo $error;
                   				?>
										<div id="subcccc"></div>
                   						<div class="form-group">
                        					<label for="inputproduct" class="col-sm-4 control-label">Product Name</label>
                        					<div class="col-sm-7">
                            					<input type="text" name="productname" id="txt3" class="form-control" id="inputproduct" placeholder="Enter Product Name" required>
                       						</div>
                        					</div>
                        				
                        				<div class="form-group">
                        					<label for="inputproductdesc" class="col-sm-4 control-label">Description</label>
                        					<div class="col-sm-7">
                            					<textarea name="desc"></textarea>
                       						</div>
                        				</div>
                        				<div class="form-group">
                        					<label for="inputprice" class="col-sm-4 control-label">Price</label>
                        					<div class="col-sm-7">
                            					<input type="text" name="price" id="txt3" class="form-control" id="inputprice" placeholder="Enter Price" required>
                       						</div>
                        				</div>
                        				<div class="form-group">
                        					<label for="inputsellingprice" class="col-sm-4 control-label">Selling Price</label>
                        					<div class="col-sm-7">
                            					<input type="text" name="selprice" id="txt3" class="form-control" id="inputsellingprice" placeholder="Enter Selling  Price" required>
                       						</div>
                        				</div>
                        				<div class="form-group">
                        					<label for="inputquantity" class="col-sm-4 control-label">Quantity</label>
                        					<div class="col-sm-7">
                            					<input type="text" name="quan" id="txt3" class="form-control" id="inputquantity" placeholder="Enter Quantity" required>
                       						</div>
                        				</div>
                        				<div class="form-group">
                        					<label for="inputquantity" class="col-sm-4 control-label">Product Image</label>
                        					<div class="col-sm-7">
                            					<input type="file" name="inputfile"  class="form-control" id="inputquantity"  required>
                       						</div>
                        				</div>

 										
										<div class="col-sm-offset-5 col-sm-7">
                            				<button type="submit" name="submitt" class="btn btn-primary">Submit</button>    
                        				</div>
										</form>
										</div></div></div>

					
					</div>		
					
					
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p></p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo base_url();?>images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo base_url();?>images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo base_url();?>images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="<?php echo base_url();?>images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="<?php echo base_url();?>images/home/map.png" alt="" />
							<p></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>