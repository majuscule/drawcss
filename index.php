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
		var context = canvas.getContext('2d');

		$('#drawing').click(function(e){

		   var x_offset = this.offsetLeft;
		   var y_offset = this.offsetTop;

		   var x_start = e.pageX - x_offset;
		   var y_start = e.pageY - y_offset;

		   var x_coord, y_coord = 'NULL';

		   $(document).mousemove(function(e){
			x_coord = e.pageX - x_offset;
			y_coord = e.pageY - y_offset;
	   	   }); 

		   $('#drawing').mouseout(function(){
			return;
		   });

		  $('#drawing').mouseup(function(){
		   	context.moveTo(x_start, y_start);
			context.lineTo(x_start, y_coord);
			context.lineTo(x_coord, y_start);

			context.moveTo(x_coord, y_coord);
			context.lineTo(x_start, y_coord);
			context.lineTo(x_coord, y_start);
		   });
		});
	});
    </script>
    <style type="text/css">
      canvas { border: 1px solid black; height: 100%; width: 100%; }
    </style>
  </head>
  <body>
    <canvas id="drawing"></canvas>
  </body>
</html>
