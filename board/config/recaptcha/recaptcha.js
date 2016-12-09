$(function(){

	$(document).on("click", "#captcha_reload", function(){
		$.ajax({
			type: 'POST',
			url: '/board/config/recaptcha/recaptcha_api.php',
			data: { gubun: "1" },
			cache: false,
			async: false,
			success: function(html) {
				$("fieldset#captcha").after(html);
			}
		});
	});
	
	$("#captcha_reload").trigger("click");

});

function chk_captcha()
{
	if ($('#g-recaptcha-response').val() == "") {
		alert("자동입력방지는 필수항목입니다.");
		return false;
	}

	return true;
}
