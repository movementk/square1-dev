jQuery(function($){
	$.datepicker.regional['ko'] = {
		
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		yearRange: 'c-20:c+20',
		changeYear: true,
		changeMonth: true,
		showButtonPanel: true,
		buttonText: '달력',
		showOn: "both",
		duration:200,
		buttonImage: "/board/config/js/datepicker/black/images/calendar.gif",
		buttonImageOnly: true,
		showMonthAfterYear: false
	};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

//	$('img.ui-datepicker-trigger').css({'cursor':'pointer', 'margin-left':'2px', , 'margin-top':'2px'});
});