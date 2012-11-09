<html>
	<head>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/hot-sneaks/jquery-ui-1.9.1.custom.css" rel="stylesheet">
	<script src="js/jquery-1.8.2.js"></script>
	<script src="js/jquery-ui-1.9.1.custom.js"></script>
	</head>
	
	
<body>

<?php

error_reporting(E_ALL);

$start_color = (@$_GET['start_color'] == "") ? "#07468A" : @$_GET['start_color'];
$font_color = (@$_GET['font_color'] == "") ? "#07468A" : @$_GET['font_color'];

$font_color = urldecode($font_color);


$percentage  = (@$_GET['percentage'] == "") ? 80 : $_GET['percentage'];

if(!preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $start_color, $parts))
  die("Not a value color");

 
$end_color = ""; // Prepare to fill with the results
$transparent_color = "rgba(";

for($i = 1; $i <= 3; $i++) {

	$parts[$i] = hexdec($parts[$i]);
	
	$transparent_color .= str_pad($parts[$i], 2, '0', STR_PAD_LEFT) . ",";

	$parts[$i] = round($parts[$i]) * $percentage/100;
	
	$end_color .= str_pad(dechex($parts[$i]), 2, '0', STR_PAD_LEFT);
	
}


$transparent_color .= "0.3)"; 



$end_color = "#" . $end_color;

?>
<style>
.ui-slider-handle { width: 310px; }
.ui-slider .ui-slider-handle { width:8px; height:12px; margin-left:-1px;  margin-top:1px;}

.ui-slider  { height:5px;  }

</style>
<script>

    $(function() {
        $( "#slider-range-min" ).slider({
            range: "min",
            value: <?php echo $percentage; ?>,
            min: 0,
            max: 100,
            slide: function( event, ui ) {
                $( "#amount" ).val(ui.value);
				
            }
        });
        $( "#amount" ).val( $( "#slider-range-min" ).slider( "value" ) );
    });

</script>


<div class="container" style="margin-top:40px;">
<div class="row" >

<div class="span12">


		<h3>Automatically generate a gradient using a percent of start color and <br/>
			generate an opacity background based on the original start color.
		</h3>

		<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

			<table class="table" style="width:400px;">
				<tr>
					<th colspan="2">Select color options</th>
				</tr>
				<tr>
					<th>Select BG Color: </th>
					<td><input id="background-color" type="color" value="<?php echo $start_color; ?>" name="start_color" style="width:30px; height:30px;"/></td>
				</tr>
				
				<tr>
					<th>Select Font Color: </th>
					<td><input id="background-color" type="color" value="<?php echo $font_color; ?>" name="font_color" style="width:30px; height:30px;" /> </td>
				</tr>

				<tr>
					<th>Select Percentage: </th>
					<td><input type="text" size="3" id="amount" value="<?php echo $percentage; ?>" name="percentage" style="width:35px; height:30px;"> <br/>
					<div id="slider-range-min" style="width:200px; display:inline-block;"></div>  <br/>
					<i><font style="font-size:10px;" >The lower the percentage, <br/>the darker the gradient transition</font></i>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:right">
						<input type="submit" class='btn btn-primary' value="Go" >
					</td>
				</tr>
				

			</table>
		</form>
		

		<div class="row" >
		
			<div class="span3">
				<h4>Start Color</h4>
				<div style="height:100px; width:100px; background-color:<?php echo $start_color; ?>"></div>
				<?php echo $start_color; ?>
			</div>	
			
			<div class="span3">
				<h4>End Color </h4>
				<div style="height:100px; width:100px; background-color:<?php echo $end_color; ?>"></div>
				<?php echo $end_color; ?>
			</div>
			
			<div class="span3">
				<h4>Gradient Color </h4>
				<div 
				style="height:100px; width:100px;
				border-top:2px solid <?php echo $end_color; ?>; 
				background: <?php echo $start_color; ?>; /* Old browsers */
				background: -moz-linear-gradient(top,  <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $start_color; ?>), color-stop(100%,<?php echo $end_color; ?>)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* IE10+ */
				background: linear-gradient(to bottom,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $start_color; ?>', endColorstr='<?php echo $end_color; ?>',GradientType=0 ); /* IE6-9 */
				">

				</div>
			</div>
			
		</div>	
		
		
		<div style="margin:0px; margin-top:10px;  margin-bottom:10px; -webkit-border-radius: 5px;
border-radius: 5px; border:1px solid #C7C7C7; background-color:#EDEDED; padding:20px; width:900px;">

				background: <?php echo $start_color; ?>; /* Old browsers */ <br/>
				background: -moz-linear-gradient(top,  <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%); /* FF3.6+ */  <br/> 
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $start_color; ?>), color-stop(100%,<?php echo $end_color; ?>)); /* Chrome,Safari4+ */  <br/>
				background: -webkit-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* Chrome10+,Safari5.1+ */  <br/>
				background: -o-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* Opera 11.10+ */  <br/>
				background: -ms-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* IE10+ */  <br/>
				background: linear-gradient(to bottom,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* W3C */  <br/>
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $start_color; ?>', endColorstr='<?php echo $end_color; ?>',GradientType=0 ); /* IE6-9 */  <br/>
				
		</pre>
		</div>
		
		


		<div style="height:150px; background:<?php echo $transparent_color; ?>">

			<div style="position:relative; padding:20px;">
				<h4> Example Build: </h4>
			</div>
			
		</div>

		<div 
		style="height:50px; width:100%;
		border-top:2px solid <?php echo $end_color; ?>; 
		background: <?php echo $start_color; ?>; /* Old browsers */
		background: -moz-linear-gradient(top,  <?php echo $start_color; ?> 0%, <?php echo $end_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $start_color; ?>), color-stop(100%,<?php echo $end_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $start_color; ?> 0%,<?php echo $end_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $start_color; ?>', endColorstr='<?php echo $end_color; ?>',GradientType=0 ); /* IE6-9 */
		">

		<ul style="margin-top:15px;">
			<?php
				for($i=0; $i<6; $i++) {
					
					?><li style="float;left; margin:0px; display:inline-block; padding-right:20px; color:<?php echo $font_color; ?>" > <b>Link <?php echo $i; ?></b></li><?php
				}
			?>	
		</ul>

		</div>
	</div>
</div>



</body>

</head>

