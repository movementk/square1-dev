if (typeof(SCAPTCHA_JS) == 'undefined') // 한번만 실행
{
	var SCAPTCHA_JS = true;
	jQuery(document).ready(function() {
		if (jQuery('#scaptcha_image').length > 0 ) { // #scaptcha_image가 존재할 때만 attr과 click을 정의
			jQuery('#scaptcha_image').attr('width', '87').attr('height','25');
			jQuery('#scaptcha_image').attr('title', '글자가 잘안보일 경우 클릭하시면 새로운 글자가 나옵니다.');
			jQuery('#scaptcha_image').click(function() {
				jQuery('#scaptcha_image').attr('src', '/board/config/securimage/securimage_show.php?sid=' + Math.random());
			});
			jQuery('#scaptcha_image').click();
		}
	});
}