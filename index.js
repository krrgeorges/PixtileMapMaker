var tp = null;
var tiles = [];
var p_tile = null
var mode = null
var dragging = false;
var ispressed = false;
var canvas_mode = 0

$(document).ready(function(){

	$("#mode-container").draggable()

	//toggle floating and bottom control relation
	$("#bottom-control-close").click(function(){
		$("#floating-grid-trigger").css("visibility","visible")
		$("#bottom-control").css("visibility","hidden")
	})
	$("#floating-grid-trigger").click(function(){
		$("#floating-grid-trigger").css("visibility","hidden")
		$("#bottom-control").css("visibility","visible")
	})

	//create canvas
	$("#create-canvas").click(function(){
		var px = parseInt($("#i-pixel-size").val())
		if(px!=NaN){
			var rows = $("#i-rows").val()
			var cols = $("#i-cols").val()
			if(rows > 0 && cols > 0){
				buildCanvas(rows,cols,px)
			}	
		}
	})


	$("#mode-draw").click(function(){
		mode = 0;
		$("#present-mode").text("DRAW")
	})
	$("#mode-erase").click(function(){
		mode = 1;
		$("#present-mode").text("ERASE")
	})

	//tilepack selection
	$(".tp-row").click(function(){
		$("#tilePackSelectorModal").modal("hide");
		console.log($(this).data("tp"))
		tp = $(this).data("tp")
		getTiles(tp)
		$("#present-tp").text(tp.substring(0,$(this).data("tp").indexOf(".")))
	})

	$("#canvas-main").click(function(e){fillStuff(e);})

	$("#canvas-main")
			.mousedown(function(){ispressed = true})
			.mousemove(function(e){if(ispressed == true){fillStuff(e);}})
			.mouseup(function(){ispressed = false})



})

function fillStuff(e){
	var elem = document.elementFromPoint(e.clientX,e.clientY);		
	if(elem.classList["value"] == "c-col"){
		if(mode == 0 || mode == null){
			if(p_tile!=null){
				$(elem).html($(elem).html()+"<img class='tilefill' src='"+p_tile+"' style='display:block;position:absolute;z-index:1;'>")
			}
		}
	}
	else if( $(elem).parent()[0].classList["value"] == "c-col" && $(elem).prop("tagName") == "IMG"){
		if(mode == 1){
			$($(elem).parent()[0]).html("");
		}
		if(mode == 0 || mode == null){
			if(p_tile!=null){
				var imgs = $(elem).parent()[0].getElementsByTagName("img")
				var dup = false
				for(var i=0;i<=imgs.length-1;i++){
					if($(imgs[i]).attr("src") == p_tile){
						dup = true
						break
					}
				}
				if(dup == false){
					$($(elem).parent()[0]).html("<img class='tilefill' src='"+p_tile+"' style='display:block;position:absolute;z-index:"+$(elem).parent()[0].getElementsByTagName("img").length+1+";'>"+$($(elem).parent()[0]).html())
				}
			}
		}
	}
}

function uniquePreviousTiles(){
	imgs = $("#previous-ptiles img")
	l = []
	for(var i=0;i<=imgs.length-1;i++){
		if(l.length > 5){
			break
		}
		if( l.indexOf($(imgs[i]).attr("src")) >= 0 ){
			$(imgs[i]).remove()
			continue
		}
		l.push($(imgs[i]).attr("src"))
	}
}

function setPTile(ptile){
	if(ptile!=undefined){
		if(p_tile!=null){
			$("#previous-ptiles").html("<img onclick='setPTile(this.src);' class='pptile' data-src='"+p_tile+"' src='"+p_tile+"' style='display:inline-block;margin-right:5px;width:32px;height:32px;'>"+$("#previous-ptiles").html())
			uniquePreviousTiles();
		}
		p_tile = ptile
		$("#present-t").html("<img class='ptile' data-src='"+p_tile+"' src='"+p_tile+"' style='display:block;width:32px;height:32px;'>")
	}
}

function getTiles(tp){
	console.log(tp)
	$.ajax({url:"./tile_server.php",data:{tp:tp},success:function(data){
		var img = null;
		html = "";
		var ttiles = JSON.parse(data);
		var px = ttiles[1][1].substring(0,ttiles[1][1].indexOf("x"))
		$("#present-px").text(px);
		for(var i=0;i<=ttiles.length-1;i++){
			html += "<div class='pc-row'>"
			for(var j=0;j<=ttiles[i].length-1;j++){
				img = "<img class='ptile' data-src='./pixshelded/pixshelded/"+tp.substring(0,tp.indexOf("."))+"/"+ttiles[i][j]+"' src='./pixshelded/pixshelded/"+tp.substring(0,tp.indexOf("."))+"/"+ttiles[i][j]+"' style='margin:5px;;display:block;width:50px;height:50px;'>"
				html += "<div class='pc-col' style='width:50px;height:50px;'>"+img+"</div>"
			}
			html += "</div>"
		}
		$("#pseudo-canvas").html(html);
		$(".ptile").click(function(){
			$("#tileSelectorModal").modal("hide");
			if($(this).data("src") != undefined){
				setPTile($(this).data("src"))
			}
		})
	}})
}

function buildCanvas(r,c,px){
	var html = "";
	var filler = "<img src='./pixshelded/pixshelded/basictiles/16x16_sprite_000.png' style='display:block;'>";
	for(var i=0;i<=r-1;i++){
		html += "<div class='c-row'>"
		for(var j=0;j<=c-1;j++){

			html += "<div class='c-col' style='width:"+px+"px;height:"+px+"px;'></div>"
		}
		html += "</div>"
	}
	$("#canvas-main").html(html)
	console.log("Building canvas...")
}