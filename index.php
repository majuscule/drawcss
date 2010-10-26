<html>
  <head>
    <title>drawcss</title>
  <script type="text/javascript" src="includes/jquery-core.js">
</script>
  <script type="text/javascript" src=
  "includes/jquery-components.js">
</script>
<!--[if IE]> <script type="text/javascript" src="includex/excanvas.js"> <![endif]-->
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

		var drawnDivs = new Array();

		function update(){
			context.drawImage(sketch, 0, 0);
			sketch_context.clearRect(0,0,canvas.width,canvas.height);
		}

		function print_html(){
			$('#markup').innerHTML = "<html><br>";
			$('#markup').innerHTML = "<head><br>";
			
			for(i=0;i<=drawnDivs.length;i++){ // off by one?
				//console.log(drawnDivs[i]);
			}
		}

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
				if(tool=='draw' && (Math.abs(x_length) > 10 || Math.abs(y_height) > 10)){
					context.strokeRect(x_start, y_start, x_length, y_height);
					context.setBaseline = "top";
					context.fillText("DIV"+numberOfDivs, x_start, y_start);
					var div = new newDiv(x_start, y_start, x_length, y_height);
					drawnDivs.push(div);
					//console.log(drawnDivs);
				}
				if(tool=='delete'){
					if(1) return; //success!
				}
				print_html();
				sketch_context.clearRect(0,0,canvas.width,canvas.height);
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
				if(tool=="move"){
					if(x_coord<=drawnDivs[0].x_start && y_coord<=drawnDivs[0].y_start){
						console.log('you\'re in it!');
					}
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
			drawnDivs.length = 0;
		});

		$('#viewmarkup').mousedown(function(e){
			$('canvas').toggle();
			$('sketch').toggle();
			$('#markup').toggle();
		});

		$('#controls li').click(function(e){
			$(this).effect('highlight', 1000);
		});

		$('#controls li.tool').click(function(e){
			$('#markup').hide();
			$('#drawing').show();
			$('#sketch').show();
		});
	});
    </script>
    <style type="text/css">
	canvas { position: absolute; top: 1px; left: 1px; }
	#controls { float:right; width:150px; }
	#controls li { cursor: pointer; padding-bottom:15px; font-weight: bold; list-style-type: none; }
	#markup { display:none; }
    </style>
  </head>
  <body>
    <div id="container"><canvas id="drawing"></canvas></div>
    <ul id="controls">
	<li id="draw" class="tool">draw</li>
	<li id="move" class="tool">move</li>
	<li id="adjust" class="tool">adjust</li>
	<li id="delete" class="tool">delete</li>
	<li id="clear">clear</li>
	<br><br><br>
	<li id="viewmarkup">view markup</li>
    </ul>
    <div id="markup">test</div>
  </body>
</html>
