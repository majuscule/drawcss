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
		var selectionBox = 'NULL';

		$('#sketch').mouseup(function(e){
		   	isDrawing = false;
			pageX = e.pageX;
			pageY = e.pageY;
			x_coord = e.pageX - x_offset;
			y_coord = e.pageY - y_offset;
			x_length = x_coord - x_start;
			y_height = y_coord - y_start;
			context.strokeRect(x_start, y_start, x_length, y_height);
			var div = new newDiv(x_start, y_start, x_length, y_height);
			drawnDivs.push(div);
			selectionBox = 'NULL';
			console.log(drawnDivs);
			update();
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
		});
		$('#sketch').mousemove(function(e){
			pageX = e.pageX;
			pageY = e.pageY;
			x_coord = e.pageX - x_offset;
			y_coord = e.pageY - y_offset;
			x_length = x_coord - x_start;
			y_height = y_coord - y_start;
			if(isDrawing) {
				if (selectionBox != 'NULL')
				sketch_context.clearRect(0,0, sketch.width, sketch.height);
				sketch_context.strokeRect(x_start, y_start, x_length, y_height);
				selectionBox = new newDiv(x_start, y_start, x_length, y_height);
			}

		});
	});
    </script>
    <style type="text/css">
      canvas { border: 1px solid black; position: absolute; top: 1px; left: 1px; }
    </style>
  </head>
  <body>
    <div id="container"><canvas id="drawing"></canvas></div>
  </body>
</html>
