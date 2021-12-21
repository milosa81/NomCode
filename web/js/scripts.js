Number.prototype.map=function(a,b,c,d){return c+(d-c)*((this-a)/(b-a))};

var headerHeight;
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

function setVignettesScrollbar() {
	$(".vignettes").mCustomScrollbar({
		scrollInertia: 0,
		theme:"minimal",
		mouseWheel:
			{
				scrollAmount: 100
			}
	});
}

function setArticleScrollbar() {
	$("article").mCustomScrollbar({
		scrollInertia: 0,
		theme:"minimal",
		mouseWheel:
			{
				scrollAmount: 100
			},
	    callbacks:{
	        whileScrolling:function(){
	        	var $bgAuthor = $('article header .author'),
	        	maxTransparency = $bgAuthor.attr("data-max-transparency");

	        	var ratio_header = -this.mcs.top/headerHeight;
	        	if (ratio_header < 1) {
	        		ratio_header = ratio_header.map(0, 1, parseFloat(maxTransparency), 1);
			        $bgAuthor.removeClass('fixed');
			        $bgAuthor.css("background-color", replaceRegexOpacity($bgAuthor.attr("data-bg-transparency"), ratio_header));
			        $("header").css("background-position", "50% "+parseFloat(-this.mcs.top)/2 +"px");
			    } else {
			        $bgAuthor.addClass('fixed');
			        $bgAuthor.css("background-color", replaceRegexOpacity($bgAuthor.css("backgroundColor"), 1));
			    }
	        }
	    }
	});
}

// set scrollbars
setVignettesScrollbar();
setArticleScrollbar();

// selectable vignettes
$(".vignettes").on('click', '.vignette', function () {
	var $vignette = $(this);
	$(".vignettes .vignette").removeClass("selected");
	$(this).addClass("selected");

	if($("article").attr("data-article-id") !== $vignette.attr("data-article-id")) {
		// we select "article div:first div:first" because of scrollbar javascript
		var $article_content = $("article div:first div:first");
		$article_content.fadeOut(200);
		$article_content.load($(this).attr("data-get"), function() {
			$("article").mCustomScrollbar("scrollTo","top");
			$("article").attr("data-article-id", $vignette.attr("data-article-id"));
			$article_content.fadeIn(200);
			$("article pre code").each(function(i, block) {
				hljs.highlightBlock(block);
			});
		});
	}
});

//*
// opacity cache over vignettes
$("section.left").hover(
	function() {
		$(".opacity-cache").removeClass("active");
	}, function() {
		$(".opacity-cache").addClass("active");
	}
);
//*/