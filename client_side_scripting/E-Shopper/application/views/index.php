<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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
     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
  	$(document).ready(function(){
  		

          

$.ajax({
		'type' :"POST",
		'url' :"http://localhost/E-Shopper_services/index.php/welcome/showcustcat",
		'datatype':"json",
		'success':function(data){
			
			
			var abc= JSON.parse(data);
 				
				
			var toAppend='';
			for (var i = 0 ; i < abc.length; i++) {


				toAppend+="<div value='"+abc[i].pk_int_cat_id+"'><button type='button' class='btn btn-link' onclick='customersubcategory(this.value);' value='"+abc[i].pk_int_cat_id+"'><span class='badge pull-left'><i class='fa fa-plus fa-fw' style='font-size:2em;'></i></span>"+abc[i].vchr_cat_name+"</button></div><div id='"+abc[i].pk_int_cat_id+"'></div>";
			};
			$('#id1').append(toAppend);

		}
	});

$.ajax({
		'type' :"POST",
		'url' :"http://localhost/E-Shopper_services/index.php/welcome/proddisplay",
		'datatype':"json",
		'success':function(data){

			
			var abc= JSON.parse(data);
 				
				
			var toAppend='';
			for (var i = 0 ; i < abc.length; i++) {


				toAppend+="<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='<?php echo base_url(); ?>uploads/"+abc[i].vchr_product_image+"'><h2>"+abc[i].int_selling_price+"</h2><p>"+abc[i].vchr_product_name+"</p><a class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Buy Now</a></div><div class='product-overlay'><div class='overlay-content'><h2>"+abc[i].int_selling_price+"</h2><p>"+abc[i].vchr_product_name+"</p><a data-target='#myModal'data-toggle='modal' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Buy Now</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'></ul></div></div></div>";
			};
			$('#pd').append(toAppend);

		}
	});


});

function customersubcategory(vall)

{
$('#'+vall+'').empty();
	$.ajax({
		'type' :"POST",
		'url' :"http://localhost/E-Shopper_services/index.php/welcome/showcustsubs",
		'datatype':"json",
		'data':{name:vall},
		'success':function(data){
			
			
			
			var abc= JSON.parse(data);
				
				
			var toAppend="";
			for (var i = 0 ; i <=abc.length-1; i++) {

				toAppend+="<li style='margin-left:18%' value='"+abc[i].pk_int_sub_id+" '><button type='button' class='btn btn-link' onclick='productimages(this.value);' value='"+abc[i].pk_int_sub_id+"'>"+abc[i].vchr_sub_name+"</button></li>";
			};
			$('#'+vall+'').append(toAppend);
			
			
}
});

}

function productimages(pic)
{
	
	$('#pd').empty();
	
	$.ajax({
		'type' :"POST",
		'url' :"http://localhost/E-Shopper_services/index.php/welcome/showproductpic",
		'datatype':"json",
		'data':{name:pic},
		'success':function(data){
			var abc= JSON.parse(data);

			var toAppend="";
			for (var i = 0 ; i <=abc.length-1; i++) {
				
					toAppend+="<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='<?php echo base_url(); ?>uploads/"+abc[i].vchr_product_image+"'><h2>"+abc[i].int_selling_price+"</h2><p>"+abc[i].vchr_product_name+"</p><a class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Buy Now</a></div><div class='product-overlay'><div class='overlay-content'><h2>"+abc[i].int_selling_price+"</h2><p>"+abc[i].vchr_product_name+"</p><a data-target='#myModal'data-toggle='modal' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Buy Now</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'></ul></div></div></div>";
			};
			$('#pd').append(toAppend);
		}
});
}


// function productdetails(pk)
// {    
	
// 	$.ajax({
// 		'type' :"POST",
// 		'url' :"<?php echo base_url(); ?>"+"index.php/welcome/showdetails",
// 		'datatype':"json",
// 		'data':{name:pk},
// 		'success':function(data){
// 			var abc= JSON.parse(data);

			
// 			for (var i = 0 ; i < abc.length; i++) {
// 				id=abc[i].pk_int_product_id;
// 				name=abc[i].vchr_product_name;
// 				price=abc[i].int_selling_price;
// 				desc=abc[i].vchr_desc;
// 				img=abc[i].vchr_product_image;
// 				quantity=abc[i].int_quantity;

					
// 			};
// 			$('#de').load('productdetails',{a:id,b:name,c:price,d:desc,e:img,f:quantity});
// 		}
// 	});
// }
  </script>
  <style>
  li
{
list-style-type: none;
}

.modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }

  </style>
    
</head><!--/head-->

<body id="de">
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" name="formlog" method="POST" action="welcome/loginuser">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" name="password" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" name="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <!-- <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button> -->
          <p>Not a member? <a href="#">Sign Up</a></p>
          <!-- <p>Forgot <a href="#">Password?</a></p> -->
        </div>
      </div>
      
    </div>
  </div> 
</div>

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
							<a href=""><img src="<?php echo base_url();?>images/home/logo.png" alt="" /></a>
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
								
								
								<li><a href="welcome/login"><i class="fa fa-lock"></i> Login</a></li>
								<li><a href="welcome/registration"><i class="fa fa-lock"></i> Register</a></li>
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
								<li id ="ab"><a href="">Home</a></li>
								<li><a href="welcome/about">About Us</a></li>
								
                                       
										 
								<li><a href="welcome/contact">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>           
	
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Designer Store</h2>
									<p>The freshest, newest pieces from covetable collections. </p>
									<a href="index.php/welcome/shop"><button type="button" class="btn btn-default get" >Get it now</button></a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo base_url();?>images/home/girl1.jpg" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>The Ultimate Winter Wardrobe</h2>
									<p>This winter, don't let your style hibernate. </p>
									<a href="index.php/welcome/shop"><button type="button" class="btn btn-default get">Get it now</button></a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo base_url();?>images/home/girl2.jpg" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Cocktail Dresses</h2>
									<p>For the festive Season. </p>
									<a href="index.php/welcome/shop"><button type="button" class="btn btn-default get">Get it now</button></a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo base_url();?>images/home/girl3.jpg" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default"><div id="id1"></div>
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul class="a">
											<li><div id='mm' ></div></li>
											
										</ul>
									</div>
								</div>
							</div>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<!-- <h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right"></span>Acne</a></li>
									<li><a href="#"> <span class="pull-right"></span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right"></span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right"></span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right"></span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right"></span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right"></span>Rösch creative culture</a></li>
								</ul>
							</div> -->
						</div><!--/brands_products-->
						
						
						
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<div id="pd">
						
						</div>
					</div><!--features_items-->
					
					<!--category-tab-->
					<!--/category-tab-->
					
					<!--recommended_items-->
					<!--/recommended_items-->
					
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