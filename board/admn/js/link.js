function bluring(){ 
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus(); 
} 
document.onfocusin=bluring; 

function msg(txt){
	alert(txt);
}

// 각페이지 경로
function gf_goUrl( pUrl ) {
	switch(pUrl) {
		//SUB_MENU_01
		case "101"  : location.href="/board/admn/setup/modify.php"; break;
		case "102"  : location.href="/board/admn/setup/use.php"; break;
		case "103"  : location.href="/board/admn/setup/personal.php"; break;
		case "104"  : location.href="/board/admn/setup/popup.php"; break;
		case "105"  : location.href="/board/admn/setup/banner.php"; break;
		case "106"  : location.href="/board/admn/category/cat.php"; break;
		case "107"  : location.href="/board/admn/setup/calendar.php"; break;
		case "108"  : location.href="/board/admn/setup/email.php"; break;
		
		//SUB_MENU_02
		case "201"  : location.href="/board/admn/board/board_adm.php"; break;
		
		//SUB_MENU_03
		case "301"  : location.href="/board/admn/operate/popup.php"; break;
		case "302"  : location.href="/board/admn/operate/banner.php"; break;
		
		//SUB_MENU_04
		case "401"  : location.href="/board/admn/member/mem_lst.php"; break;
		
		//SUB_MENU_05[member]
		case "500"  : window.open("about:blank").location.href="http://www.google.com/analytics/"; break;
		case "501"  : location.href="/board/admn/stats/user.php"; break;
		case "502"  : location.href="/board/admn/stats/page.php"; break;
		case "503"  : location.href="/board/admn/stats/url.php"; break;
		case "504"  : location.href="/board/admn/stats/referer.php"; break;
		case "505"  : location.href="/board/admn/stats/browser.php"; break;
		
		//SUB_MENU_06[member]
		case "601"  : location.href="/board/admn/category/cat.php"; break;

	}
}


function nextFocus(sFormName,sNow,sNext)
{
	var sForm = 'document.'+ sFormName +'.'
	var oNow = eval(sForm + sNow);

	if (typeof oNow == 'object')
	{
		if ( oNow.value.length == oNow.maxLength)
		{
			var oNext = eval(sForm + sNext);

			if ((typeof oNext) == 'object')
				oNext.focus();
		}
	}
}