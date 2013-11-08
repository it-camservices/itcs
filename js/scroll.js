// JavaScript Document
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

"</div>"
						'<div style="position:absolute; top:513; left:0; z-index:1">'
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