<?php include('include/initailize.php');?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
	global $database;
	$sql = $database->sql_query("SELECT * FROM tbl_webpage WHERE web_id=1");
	$web = $database->fetch_array($sql);
?>
<title><?php echo $web['site_title'];?></title>
<meta id="description1" name="description" content="<?php $web['site_description'];?>" />
<meta id="keywords1" name="keywords" content="<?php echo $web['site_keyword'];?>" />
	<?php include('include/script.php');?>
</head>
<body>
	<div id="container">
    	<?php include_once("include/header.php"); ?>
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
            	<?php include_once("include/domain-search.php"); ?>
                <!-- end class domainarea -->
				<div class="hosting_plans">
					<?php include_once("include/service.php"); ?>
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