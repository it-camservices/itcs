<div id="c_js1" style="overflow:hidden;height:100%;width:100%;">	
                      <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            
                            <?php
							global $database;
							$sql = $database->sql_query("SELECT * FROM tbl_client ORDER BY order_by ASC");
							while($client = $database->fetch_array($sql))
							{
						?>
                        	<td id="p1_js1" valign="middle" style="white-space: nowrap">
								<a href="<?php echo $client['link'];?>" target="_blank"><img border="0" src="media/ourclient/<?php echo $client['photo'];?>" title="<?php echo $client['client_name'];?>" hspace="5"></a>
                           </td>
                           <td>&nbsp;</td>
						<?php } ?>	
                        </tr>
                      </table>
                    </div>
                    <script>
						var speed=30
						var i=0
						var n=Math.floor(js1.offsetWidth/p1_js1.offsetWidth)
						for (i=0;i<=n;i++)
						{
						p2_js1.innerHTML+=p1_js1.innerHTML
						}
						function m_js1()
						{
						if(c_js1.scrollLeft>=p1_js1.offsetWidth)
						  c_js1.scrollLeft-=p1_js1.offsetWidth
						else
						  c_js1.scrollLeft++
						}
						var mm_js1=setInterval(m_js1,speed) 
						c_js1.onmouseover=function(){clearInterval(mm_js1)} 
						c_js1.onmouseout=function(){mm_js1=setInterval(m_js1,speed)} 
						</script></div>
						<div style="position:absolute; top:513; left:0; z-index:1">
						<script language=JavaScript>
						<!--
						var itv = 50;
						var step = 10;
						var start = 0;
						var end = 0;
						var currentOpac;
						
						//change the opacity for different browsers
						function changeOpac(obj, opacity) {
							var object = obj.style; 
							object.opacity = (opacity / 100);
							object.MozOpacity = (opacity / 100);
							object.KhtmlOpacity = (opacity / 100);
							object.filter = "alpha(opacity=" + opacity + ")";
						}
						
						function BeginOpacity(obj, s, e)
						{
							start = s;
							end = e;
							currentOpac = s;
							theobject=obj;
							changing=setInterval("opacityit(theobject)",itv);
						}
						
						function EndOpacity(obj, end){
							clearInterval(changing);
							changeOpac(obj, end);
						}
						
						function opacityit(obj){
							if(start > end) {
								if (currentOpac>end){
									currentOpac = currentOpac - step;
									changeOpac(obj,currentOpac);
								}
								else if (window.highlighting)
									clearInterval(highlighting);
							} else if(start < end) {
								if (currentOpac<end){
									currentOpac = currentOpac + step;
									changeOpac(obj,currentOpac);
								}
								else if (window.changing)
									clearInterval(changing);
							}
						}
						//-->
						</script>