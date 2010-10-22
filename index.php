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

		$('#drawing').mouseup(function(e){
			pageX = e.pageX;
			pageY = e.pageY;
			x_coord = e.pageX - x_offset;
			y_coord = e.pageY - y_offset;
			x_length = x_coord - x_start;
			y_height = y_coord - y_start;
			console.log("coords:"+pageX+","+pageY);
			console.log("starts:"+x_start + "," + y_start);
			console.log("ends:"+x_coord + "," + y_coord);
			context.strokeRect(x_start, y_start, x_length, y_height);
		});

		$('#drawing').mousedown(function(e){
		   x_offset = this.offsetLeft;
		   y_offset = this.offsetTop;
		   x_start = e.pageX - x_offset;
		   y_start = e.pageY - y_offset;
		});
	});
    </script>
    <style type="text/css">
      canvas { border: 1px solid black; }
    </style>
  </head>
  <body>
    <canvas id="drawing"></canvas>
  </body>
</html>
