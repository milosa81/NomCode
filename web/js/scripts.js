Number.prototype.map=function(a,b,c,d){return c+(d-c)*((this-a)/(b-a))};

var $bgAuthor = $('article header .author'),
	headerHeight,
	maxTransparency = $bgAuthor.attr("data-max-transparency");
defineHeaderHeight();

$(window).resize(function() {
	defineHeaderHeight();
});

function defineHeaderHeight() {
	headerHeight = $("header").height()-$("header .author").height();
}

function replaceRegexOpacity(str, opacity) {
	return str.replace(/(rgba\(([0-9 ]+,){3}) *([0-9\.]+) *(\))/, "$1 "+opacity+"$4");
}

// scrollbars and author colored bar opacity
$(".vignettes").mCustomScrollbar({
	scrollInertia: 0,
	theme:"minimal",
	mouseWheel:
		{
			scrollAmount: 100
		}
});
$("article").mCustomScrollbar({
	scrollInertia: 0,
	theme:"minimal",
	mouseWheel:
		{
			scrollAmount: 100
		},
    callbacks:{
        whileScrolling:function(){
        	var ratio_header = -this.mcs.top/headerHeight;
        	if (ratio_header < 1) {
        		ratio_header = ratio_header.map(0, 1, parseFloat(maxTransparency), 1);
		        $bgAuthor.removeClass('fixed');
		        $bgAuthor.css("background-color", replaceRegexOpacity($bgAuthor.attr("data-bg-transparency"), ratio_header));
		        $("header").css("background-position-y", parseFloat(-this.mcs.top)/2 +"px");
		    } else {
		        $bgAuthor.addClass('fixed');
		        $bgAuthor.css("background-color", replaceRegexOpacity($bgAuthor.css("backgroundColor"), 1));
		    }
        }
    }
});

// selectable vignettes
$(".vignettes").on('click', '.vignette', function () {
	$(".vignettes .vignette").removeClass("selected");
	$(this).addClass("selected");
});


//*
// opacity cache over vignettes
$(".vignettes, nav").hover(
	function() {
		$(".opacity-cache").removeClass("active");
	}, function() {
		$(".opacity-cache").addClass("active");
	}
);
//*/