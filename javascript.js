// JavaScript Document

function navFunction() {
	var x = document.getElementById("topNav");
	if (x.className === "nav") {
 		x.className += " responsive";
	} else {
		x.className = "nav";
	}
}

$(document).ready(function() {
	$(".projects").mouseover(function() {
		$(this).css("color", "#fffdfd");
	});
	$(".projects").mouseout(function() {
		$(this).css("color", "black");
	});
});

$(document).ready(function() {
	$(".li3").hover(function() {
		$(".hideInMenu").slideToggle("slow");
	});
});

$(document).ready(function() {
	$(".ui-widget-content").draggable();
	$("#droppable").droppable( {
		drop: function(event, ui) {
			$(this)
			.addClass("ui-state-highlight")
			.find("p");
	 	}
	});
});

function drawImage(imageName, canvas) {
	var c = document.getElementById(canvas);
	var ctx = c.getContext("2d");
	var img = document.getElementById(imageName);
	
	ctx.rotate(Math.PI/18);
	ctx.drawImage(img, 10, 0, img.width, img.height);
}