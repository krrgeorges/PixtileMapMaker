<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title></title>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Press+Start+2P">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">




  
	<script src="./jquery.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="./html2canvas.js"></script>
	<script type="text/javascript" src="./index.js"></script>


	<style type="text/css">
		*{
			font-family: "Press Start 2P";
		}
		body{
			background-color: #17202a;
		}
		#header-control{
			color:white;
			padding-left: 5px;
			padding-right: 5px;
		}
		#bottom-control{
			background-color: #212f3d;
			position: fixed;
			bottom: 0%;
			height: 40px;
		}

		#floating-grid-trigger{
			visibility: hidden;
			z-index:10;
			margin-bottom:20px;
			float:right;
			right:0%;
			position: fixed;
			bottom:0%;
			margin-right: 20px;
		}
		.c-row{
			white-space: nowrap;
			line-height:0px;
		}
		.c-col{
			position: relative;
			background-color:white;
			display: inline-block;
		}
		.pc-row{
			white-space: nowrap;
			line-height:0px;
		}
		.pc-col{
			background-color:white;
			display: inline-block;
		}
		#previous-ptiles{
			overflow-x:scroll;
			white-space: nowrap;
		}
		#mode-container{
			width:fit-content;
			bottom: : 0%;
			float: left;
			padding: 10px;
			background-color: #2ecc71;
			border-radius: 10px;
			position: absolute;
			z-index: 10000;
		}
		.tilefill{
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
	</style>

</head>


<section id="mode-container">
	<button class="btn btn-primary btn-sm" id="mode-draw"><i class="fa fa-pencil"></i></button>	
	<button class="btn btn-primary btn-sm" id="mode-erase"><i class="fa fa-eraser"></i></button>
	<button class="btn btn-primary btn-sm" id="tileimg" data-toggle="modal" data-target="#tileImageModal"><i class="fa fa-picture-o"></i></button>		
</section>


<body>

	<!-- controls -->

	<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light" id="header-control" style="background-color: #212f3d!important;">
		<div class="col-lg-1">
			PMM
		</div>
		<div class="col-lg-2">
			<button class="btn btn-success btn-sm" id="tilepack-selector" data-toggle="modal" data-target="#tilePackSelectorModal">TilePack</button>
		</div>
		<div class="col-lg-1">
			<button class="btn btn-success btn-sm" id="tile-selector"  data-toggle="modal" data-target="#tileSelectorModal">Tile</button>
		</div>
		<div class="col-lg-3" id="previous-ptiles" style="border: 1px solid white;border-radius: 10px;font-size: 12px;padding: 5px;">
			
		</div>

		<div class="col-lg-2" style="font-size: 12px;padding: 5px;" id="present-tp">
			TilePack
		</div>

		<div class="col-lg-1" style="font-size: 12px;padding: 5px;" id="present-t">
			Icon
		</div>
		<div class="col-lg-1" style="font-size: 12px;padding: 5px;" id="present-px">
			px
		</div>
		<div class="col-lg-1" style="font-size: 12px;padding: 5px;" id="present-mode">
			Mode
		</div>
	</nav>


	<div class="" id="canvas-main" style="margin:10px;padding-bottom: 100px;">

	</div>

	<button class="btn btn-primary btn-lg" id="floating-grid-trigger"><i class="fa fa-th"></i></button>

	


	<div class="col-lg-12" id="bottom-control">
		<div class="row">
			<div class="col-lg-3">
				<div class="form-group">
				    <select class="form-control form-control-sm" id="i-pixel-size">
				      <option value="f">Pixel Size</option>
				      <option value="8">8x8</option>
				      <option value="16">16x16</option>
				      <option value="32">32x32</option>
				    </select>
				</div>		
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<input type="number" id="i-rows" name="i-rows" class="form-control form-control-sm" placeholder="Rows"/>
				</div>		
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<input type="number" id="i-cols" name="i-cols" class="form-control form-control-sm" placeholder="Columns"/>
				</div>		
			</div>
			<div class="col-lg-2">
				<div class="form-group">
					<center><button id="create-canvas" class="btn btn-primary btn-sm">CREATE CANVAS</button></center>
				</div>		
			</div>
			<div class="col-lg-1">
				<button class="btn btn-danger btn-sm" id="bottom-control-close"><i class="fa fa-close"></i></button>
			</div>
		</div>
	</div>


<!-- For TilePack -->
<div class="modal fade" id="tilePackSelectorModal" tabindex="-1" role="dialog" aria-labelledby="tilePackSelectorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tilePackSelectorModalLabel">TilePack Selecor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<?php
      		$fol = dirname(__FILE__);
      		$match_path = $fol."/pixshelded/pixshelded_match";
      		$packs = array_diff(scandir($match_path), array('.', '..'));
      	?>

      	<?php foreach ($packs as $key => $value) : ?>
      		<div class="row tp-row" style="border: 1px solid black;border-radius: 10px;" data-tp="<?php echo $value ?>">
	        	<div class="col-lg-6">
	        		<img src="./pixshelded/pixshelded_match/<?php echo $value ?>">
	        	</div>
	        	<div class="col-lg-6">
	        		<?php echo $value ?>
	        	</div>	
        	</div>
        	<br/>
      	<?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="tileSelectorModal" tabindex="-1" role="dialog" aria-labelledby="tileSelectorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tilePackSelectorModalLabel">Tile Selector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div class="col-lg-12" id="pseudo-canvas">
      		Select Tilepack First(If selected, please wait for a while for the tilesprites to load)
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="tileImageModal" tabindex="-1" role="dialog" aria-labelledby="tileImageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tilePackSelectorModalLabel">Art.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div class="col-lg-12" id="pseudo-canvas">
      		Select Tilepack First 
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>










</body>





</html>