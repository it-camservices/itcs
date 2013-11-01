<div class="right_column_list">
	<div id="right_title">Latest Website Project</div>
    	<ul>
        <?php
			global $database;
			$sql = $database->sql_query("SELECT * FROM tbl_client ORDER BY order_by ASC");
			while($latest = $database->fetch_array($sql))
			{
		?>
         	<li><a href="#" title="Explore Vanishing Culture"><?php echo $latest['client_name'];?></a></li>
       	<?php } ?>
        </ul>
</div><!-- end class right_column_list -->
<div class="right_column_list">
	<div id="right_title">Visitor Counter</div>
		<?php include('include/counter.php');?>
</div><!-- end class right_column_list -->
<div class="right_column_list">
	<div id="right_title">Find Us On Facebook</div>
	<div class="fb-like-box" data-href="https://www.facebook.com/pages/it-camservicesnet/201462899937440" data-width="248" data-height="The pixel height of the plugin" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false">
    </div>
</div><!-- end class right_column_list -->