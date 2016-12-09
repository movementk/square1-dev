(function($) {
	$(document).on("focus", "#global-search-keyword", function(){
		$("#global-search-result").attr({"style":"display:inline-block !important;"});
	});

	$(document).on("blur", "#global-search-keyword", function(){
		//setTimeout(function(){ $("#global-search-result").attr({"style":"display:none !important;"}); }, 500);
        if ($(this).val() == '') {
            $("#global-search-result").hide();
        } else {
            window.setTimeout(function() {
                $("#global-search-result").hide();
            }, 500);
        }
	});

	$(document).on("keyup", "#global-search-keyword", function(){
		var stx = $(this).val();
		$.ajax({
			type: 'POST',
			url: '/board/config/ajax/ajax_auto_complete.php',
			data: "stx="+stx,
			cache: false,
			async: false,
			success: function(data) {
				$("#global-search-result").html(data);
			}
		});
	});

	$(document).on("click", "#global-search-button", function(){
		var href = $(".global-search-result-li").eq(0).find("a").attr("href");
		location.href = href;
	});

	
	$(document).on("focus", "#search-store-name", function(){
		$("#search-store-result").attr({"style":"display:block !important;"});
	});

	$(document).on("blur", "#search-store-name", function(){
		//setTimeout(function(){ $("#search-store-result").attr({"style":"display:none !important;"}); }, 500);
        if ($(this).val() == '') {
            $("#search-store-result").hide();
        } else {
            window.setTimeout(function() {
                $("#search-store-result").hide();
            }, 500);
        }
	});

	$(document).on("keyup", "#search-store-name", function(){
		var stx = $(this).val();
		$.ajax({
			type: 'POST',
			url: '/board/config/ajax/ajax_auto_complete.php',
			data: "stx="+stx,
			cache: false,
			async: false,
			success: function(data) {
				$("#search-store-result").html(data);
			}
		});
	});

	$(document).on("click", "#search-store-button", function(){
		var href = $(".global-search-result-li").eq(0).find("a").attr("href");
		location.href = href;
	});
})(jQuery);