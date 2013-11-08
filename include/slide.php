	<div id="wowslider-container1">
	<div class="ws_images">
    	<ul>
        <?php
		global $database;
		$sql = $database->sql_query("SELECT * FROM tbl_slide ORDER BY order_by ASC");
		while($slide = $database->fetch_array($sql))
		{
	?>
			<li><img src="media/slider/<?php echo $slide['images'];?>" title="<?php echo $slide['title'];?>" id="wows1_0"/><?php echo $slide['description'];?></li>
	<?php } ?>
        </ul>
  	</div>
	<div class="ws_bullets">
    	<div>
			<a href="#" title="Our Services"><img src="images/slide/tooltips/slider1.jpg" alt="Our Services"/>1</a>
			<a href="#" title="slider2"><img src="images/slide/tooltips/slider2.jpg" alt="slider2"/>2</a>
			<a href="#" title="slider3"><img src="images/slide/tooltips/slider3.jpg" alt="slider3"/>3</a>
		</div>
   	</div>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="slide-resource/wowslider.js"></script>
	<script type="text/javascript" src="slide-resource/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
    <div style="height:2px; background:#039; width:100%;"></div>