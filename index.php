<html>
  <head>
    <title>drawcss</title>
  <script type="text/javascript" src="includes/jquery-core.js">
</script>
  <script type="text/javascript" src=
  "includes/jquery-components.js">
</script>
    <script type="text/javascript">
	jQuery(document).ready(function(){

		var canvas = document.getElementById('drawing');
		canvas.width = 900;
		canvas.height = $(window).height();
		var context = canvas.getContext('2d');
		var pageY = 'null';
		var pageX = 'null';

		var x_offset = 'NULL';
		var y_offset = 'NULL';
		var x_start = 'NULL';
		var y_start = 'NULL';
		var x_coord, y_coord = 'NULL';

		var isDrawing = false;
		var numberOfDivs = 0;
		var tool = 'draw';

		function newDiv(div_start_x, div_start_y, div_width, div_height){
			this.x_start = div_start_x;
			this.y_start = div_start_y;
			this.width = div_width;
			this.height = div_height;
		}

		var container = canvas.parentNode;
		var sketch = document.createElement('canvas');
		sketch.id = "sketch";
		sketch.width = canvas.width;
		sketch.height = canvas.height;
		container.appendChild(sketch);
		var sketch_context = sketch.getContext('2d');

		function update(){
			context.drawImage(sketch, 0, 0);
			sketch_context.clearRect(0,0,canvas.width,canvas.height);
		}

		var drawnDivs = new Array();

		$('#sketch').mouseup(function(e){
			if(isDrawing){
				isDrawing = false;
				numberOfDivs++;
				pageX = e.pageX;
				pageY = e.pageY;
				x_coord = e.pageX - x_offset;
				y_coord = e.pageY - y_offset;
				x_length = x_coord - x_start;
				y_height = y_coord - y_start;
				if(tool=='draw'){
					context.strokeRect(x_start, y_start, x_length, y_height);
					context.setBaseline = "top";
					context.fillText("DIV"+numberOfDivs, x_start, y_start);
					var div = new newDiv(x_start, y_start, x_length, y_height);
					drawnDivs.push(div);
					console.log(drawnDivs);
				}
				if(tool=='delete'){
					if(1) return;
				}
				update();
			}
		});

		$('#sketch').mousedown(function(e){
		   isDrawing = true;
		   x_offset = this.offsetLeft;
		   y_offset = this.offsetTop;
		   x_start = e.pageX - x_offset;
		   y_start = e.pageY - y_offset;
		});

		$('#sketch').mouseout(function(e){
		   isDrawing = false;
		   sketch_context.clearRect(0,0, sketch.width, sketch.height);
		});
		$('#sketch').mousemove(function(e){
			pageX = e.pageX;
			pageY = e.pageY;
			x_coord = e.pageX - x_offset;
			y_coord = e.pageY - y_offset;
			x_length = x_coord - x_start;
			y_height = y_coord - y_start;
			if(isDrawing) {
				if(tool=="draw"){
					sketch_context.clearRect(0,0, sketch.width, sketch.height);
					sketch_context.strokeRect(x_start, y_start, x_length, y_height);
				}
			}

		});


		$('#draw').mousedown(function(e){
			tool = 'draw';
		});

		$('#move').mousedown(function(e){
			tool = 'move';
		});

		$('#adjust').mousedown(function(e){
			tool = 'adjust';
		});

		$('#delete').mousedown(function(e){
			tool = 'delete';
		});

		$('#clear').mousedown(function(e){
			context.clearRect(0,0, sketch.width, sketch.height);
			numberOfDivs = 0;
		});
	});
    </script>
    <style type="text/css">
	canvas { position: absolute; top: 1px; left: 1px; }
	#controls { float:right; width:150px; }
	#controls li { cursor: pointer; padding-bottom:15px; font-weight: bold; list-style-type: none; }
    </style>
  </head>
  <body>
    <div id="container"><canvas id="drawing"></canvas></div>
    <div id="controls">
	<ul>
	<li id="draw">draw</li>
	<li id="move">move</li>
	<li id="adjust">adjust</li>
	<li id="delete">delete</li>
	<li id="clear">clear</li>
	<br><br><br>
	<li id="viewmarkup">view markup</li>
	</ul>
    </div>
  </body>
</html>
