<div id="nav">
	<div style="width:998px; background:#000; border-top:1px solid #003351">
		<div class="menu_templ">
		<ul class="topmenu" id="css3menu1">
			<li class="topmenu"><a title="Home" style="height: 25px; line-height: 25px;" href="index.php"><img alt="" src="menu-resources/home.png">Home</a></li>
			<li class="topmenu"><a title="Product info" style="height: 25px; line-height: 25px;" href="our-services.php"><span><img alt="" src="menu-resources/equalizer.png">Services</span></a>
            	<ul>
                <?php
					global $database;
					$sql = $database->sql_query("SELECT * FROM tbl_service ORDER BY order_by ASC");
					while($service = $database->fetch_array($sql))
					{
				?>
                  <li><a title="<?php echo $service['name'];?>" href="#"><?php echo $service['character'];?><?php echo $service['name'];?></a></li>

				<?php } ?>
                </ul>
            </li>
			<li class="topmenu"><a title="Product info" style="height: 25px; line-height: 25px;" href="domain-name.php"><span><img alt="" src="menu-resources/activity.png">Domain</span></a></li>
			<li class="topmenu"><a title="Product info" style="height: 25px; line-height: 25px;" href="hosting.php"><span><img alt="" src="menu-resources/bars.png">Hosting</span></a></li>
			<li class="topmenu"><a title="Samples" style="height: 25px; line-height: 25px;" href="about-us.php"><span><img alt="" src="menu-resources/location.png">About Us</span></a></li>
			<li class="topmenu"><a title="Samples" style="height: 25px; line-height: 25px;" href="our-client.php"><span><img alt="" src="menu-resources/popup.png">Our Client</span></a>
				<ul>
                <?php
					$sql = $database->sql_query("SELECT * FROM tbl_client_category ORDER BY cate_id ASC");
					while($service = $database->fetch_array($sql))
					{
				?>
                  <li><a title="<?php echo $service['cate_name'];?>" href="#"><?php echo $service['character'];?><?php echo $service['cate_name'];?></a></li>

				<?php } ?>					
				</ul>
			</li>
            <li class="topmenu"><a title="Samples" style="height: 25px; line-height: 25px;" href="our-experiences.php"><span><img alt="" src="menu-resources/popup.png">Experience</span></a></li>
			<li class="topmenu"><a title="Samples" style="height: 25px; line-height: 25px;" href="#"><span><img alt="" src="menu-resources/mail.png">Contact Us</span></a>
                <ul>
                	<li>
                    <div style="background:#FFF; padding:10px;">
                    	<form id="form1" name="form1" method="post" action="#">
                          <p>
                            <input type="text" name="textfield" id="textfield" tabindex="1" class="txtinput" placeholder="* Your Full Name Here:" required>
                          </p>
                          <p>
                            <input type="email" name="email" id="email" tabindex="2" class="txtinput" placeholder="* Email Address:" required>
                          </p>
                          <p>
                            <input type="tel" name="tel" id="tel" tabindex="3"  class="txtinput" placeholder="Mobile Number:">
                            </p>
                          <p>
                              <input type="url" name="url" id="url" tabindex="4" class="txtinput"  placeholder="Web Address:">
                            </label>
                          </p>
                          <p>
                            <textarea name="textarea" id="textarea" tabindex="5" class="txtinput" placeholder="* Your Message:" required></textarea>
                          </p>
                          	<section id="buttons">
                                <input type="reset" name="reset" id="resetbtn" tabindex="6" class="resetbtn" value="Reset">
                                <input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Submit this!">
                                <br style="clear:both;">
                            </section>
                        </form>
                    </div>
                   </li>
                </ul>
            </li>
		</ul>
		</div>
	</div>
</div>