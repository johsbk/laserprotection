{% extends "layout.tpl" %}
{% block head %}
	{{ parent() }}
	<script type="text/javascript">
		var points = [];
		{% for v in vs %}
			points[{{ loop.index0 }}] = { x: {{ v.x }}*3-1, y: {{ v.y }}*3-1 };
		{% endfor %}
		var testpoints = [];
		{% for v in testpts %}
			testpoints[{{ loop.index0 }}] = { x: {{ v.x }}*3-1, y: {{ v.y }}*3-1 };
		{% endfor %}
		var ch = [];
		{% for v in ch %}
			ch[{{ loop.index0 }}] = { x: {{ v.x }}*3, y: {{ v.y }}*3 };
		{% endfor %}
		var defense = [];
		{% for l in defense %}
			defense[{{ loop.index0 }}] = { x1: {{ l.v1.x }}*3, y1: {{ l.v1.y }}*3, x2: {{ l.v2.x }}*3, y2: {{ l.v2.y }}*3 };
			
		{% endfor %}		
		var ignore = [];
		var orgdefense = defense;
		var Draw = {
			firstclick : null,
			init : function () {
				Draw.draw();
				$("#canvas").click(Draw.click);
			},
			draw : function () {
				var canvas = $("#canvas").get(0);
				var c = canvas.getContext('2d');
				c.fillStyle = "#FFFFFF";
				c.fillRect(0,0,canvas.width,canvas.height);
				c.beginPath();
				c.moveTo(ch[0].x,ch[0].y);
				c.strokeStyle = "#FF0000"
				for (var i=1;i<ch.length;i++) {
					c.lineTo(ch[i].x,ch[i].y);				
				}
				c.lineTo(ch[0].x,ch[0].y);
				c.stroke();
				c.fillStyle="#000000";
				for (var i=0;i<points.length;i++) {
					c.fillRect(points[i].x,points[i].y,3,3);
				}
				c.fillStyle="#0000FF"
				for (var i=0;i<testpoints.length;i++) {
					c.fillRect(testpoints[i].x,testpoints[i].y,3,3);
				}
				c.strokeStyle = "#00FF00";
				c.beginPath();
				var cost = 0;
				var html = "";
				for (var i=0;i<defense.length;i++) {
					if (!ignore[i]) {
						c.moveTo(defense[i].x1,defense[i].y1);
						c.lineTo(defense[i].x2,defense[i].y2);
						cost += Draw.distance(defense[i].x1/3,defense[i].y1/3,defense[i].x2/3,defense[i].y2/3);
					}
					html += "e"+i+" <input type=\"button\" onclick=\"Draw.hideEdge("+i+")\" value=\"";
					if (ignore[i]) {
						html += "show";
					} else {
						html += "hide";
					}
					html += "\" /><br />";
				}
				c.stroke();
				$("#cost").html(cost);
				$("#edges").html(html);
			},
			hideEdge : function (i) {
				
				ignore[i] = !ignore[i];
				Draw.draw();
			},
			distance : function (x1,y1,x2,y2) {
				return Math.sqrt(Math.pow(x2-x1,2)+Math.pow(y2-y1,2));
			},
			clear : function () {
				defense = [];
				ignore = [];
				Draw.draw();
			},
			reset : function () {
				defense = orgdefense;
				ignore = [];
				Draw.draw();
			},
			click : function (e) {
				var canvas = $("#canvas").get(0);
				var c = canvas.getContext('2d');
				var v = {
					x : e.pageX-$("#canvas").offset().left,
					y: e.pageY-$("#canvas").offset().top
					};
				if (Draw.firstclick == null) {
					Draw.firstclick = v;
				} else {
					var v2 = Draw.firstclick;
					defense[defense.length]= {x1 : v.x, y1 : v.y, x2: v2.x, y2: v2.y}; 
					Draw.firstclick = null;
					Draw.draw();
				}
			}
		};
		$(Draw.init);
	</script>
{% endblock %}
{% block content %}
	<table>
	<tr><td>
	<canvas id="canvas" height="600" width="600">No canvas support</canvas>
	</td><td>
		<div id="edges"></div>
		<input type="button" onclick="Draw.clear()" value="clear" />
		<input type="button" onclick="Draw.reset()" value="reset" />
		<div id="cost"></div>
	</td></tr>
	</table>
	
{% endblock %}