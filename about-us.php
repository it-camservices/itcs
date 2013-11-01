<?php include('include/initailize.php');?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
	global $database;
	$sql = $database->sql_query("SELECT * FROM tbl_webpage WHERE web_id=5");
	$web = $database->fetch_array($sql);
?>
<title><?php echo $web['site_title'];?></title>
<meta id="description1" name="description" content="<?php $web['site_description'];?>" />
<meta id="keywords1" name="keywords" content="<?php echo $web['site_keyword'];?>" />

<link href="styles/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-resources/menu.css">
<link rel="stylesheet" type="text/css" href="slide-resource/style.css" />
<script type="text/javascript" src="slide-resource/jquery.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>
<body>
	<div id="container">
    	<div id="top_wrap">	
        	<div id="top_menu">
				<div class="ukusa">
					<?php echo date("l")."&nbsp;,&nbsp;".date("F")."&nbsp;,&nbsp;".date("Y");?>
				</div><!-- end class ukusa -->
				<div class="email">
					<a href="#" title="text link">Submit Support Ticket</a>
				</div><!-- end class email -->
				<div class="phone">
					Tel: +855 97 222 0400
				</div><!-- end class phone -->
				<div class="login">
					<a href="#" title="text link">Login</a>
				</div><!-- end class login -->
				<div class="livechat">
					<a href="skype:chhay_pearin99" title="text link">Live Chat</a>
				</div><!-- end class livechat -->
				<div class="clear"></div><!-- end class clear -->
			</div><!-- end id top_menu -->
		</div><!-- end id top_wrap -->
		<div id="header_wrap">
			<div id="header">
				<div class="logo">
					<a href="" title="link">
                    <img src="images/small.png" height="80" alt="" title="IT Cam Services"/>
                    <h1>IT Cambodia Services</h1></a>
                    <h2>The Best Services of Information Technology</h2>
                    
				</div><!-- end class logo -->
				<div id="midmenu">
					<ul>
                        <li><a href="" title="text link" class="home">Home</a></li>
                        <li><a href="" title="text link" class="aboutus">Affiliates</a></li>
                        <li><a href="" title="text link" class="support">F.A.Q's</a></li>
                        <li class="nobg"><a href="" title="text link" class="contactus">Contact Us</a></li>
                    </ul>
				</div><!-- end id midmenu -->
				<div class="clear"></div><!-- end class clear -->
                
                <!-- Horizental menu-->
					<?php include_once("include/menu.php"); ?>
                 <!--end Horizental menu-->
                <!-- end id dropdown -->
				<div class="clear"></div><!-- end class clear -->
			</div><!-- end id header -->
		</div><!-- end id header_wrap -->
		<div class="bannercon">
        <!-- Start class coda-slider-wrapper -->
			<?php include_once("include/slide.php"); ?>
            
        <!-- end class coda-slider-wrapper -->
            
  		</div><!-- end class bannercon -->
		<div id="mainbg">
			<div class="wrapper">
            	<?php //include_once("include/domain-search.php"); ?>
                <!-- end class domainarea -->
				<div class="hosting_plans">
					<?php //include_once("include/service.php"); ?>
				</div><!-- end class hosting_plans -->
					<div id="content_area">
						<div id="right_sidebar">
							<?php require_once('include/right-content.php');?>
                        </div><!-- end id right_sidebar -->
						<div id="left_content">
							<div class="ws-title"><h1><?php echo $web['page_title'];?></h1></div>
                            <?php echo $web['descriptions'];?>
						</div><!-- end id left_content -->
					</div><!-- end id content_area -->
					<div class="clear"></div><!-- end class clear -->
				</div><!-- end class wrapper -->
                <div id="js1" style="overflow:hidden; left:0px; top:0px; width:100%; height:auto; z-index:0; margin-bottom:10px;">
                    <?php require_once('include/slide-client.php');?>
			</div><!-- end id main -->
			<div id="top_footer">
				<?php require_once('include/footer.php');?>
			</div><!-- end id top_footer -->
			<div id="bottom_footer">
				<div class="wrapper">
  					<div class="left_bottom">
                        <ul>
                            <li>Copyright &copy; <?php echo date("Y");?><a href="#">&nbsp;</a></li>
                            <li><a href="" title="Go www.it-camservices.com">www.it-camservices.com</a> </li>
                        </ul>
					</div><!-- end class left_bottom -->
					<div class="clear"></div><!-- end class clear -->
				</div><!-- end class wrapper --> 
			</div><!-- end id bottom_footer -->
		</div><!-- end id container -->
</body>
</html>