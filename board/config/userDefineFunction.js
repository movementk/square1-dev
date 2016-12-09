////////////////////////////////////////////////////////////////////////////////
// 함수명 : 새창 열기
// 인자값 : 출력문자열, 출력구분(I 입력, B 자릿수, N 숫자형, ON 정수형), 객체명
////////////////////////////////////////////////////////////////////////////////

function winOpen(file){
	var str;
	str="width=400,height=200";
	str+=",top="+(150);
	str+=",left="+((screen.width/2)-200);
	str+=",location=no";
	str+=",menubar=no";
	str+=",status=no";
	str+=",resizable=no";
	str+=",scrollbars=no";
	
 	window.open(file,"_new",str);
}

////////////////////////////////
// 입력, 수정, 삭제 메세지 설정
////////////////////////////////
var required_msg   = " 입력 하십시요.";
var byte_msg       = " 자릿수 확인 하십시요.";
var number_msg     = "은(는) 숫자형 입니다.";
var onlyNumber_msg = "은(는) 정수형 입니다.";
var edit_msg       = "수정 하시겠습니까?";
var delete_msg     = "삭제 하시겠습니까?";
var select_msg     = " 선택하십시요."
////////////////////////////////////////////////////////////////////////////////
// 함수명 : alert 메세지 출력
// 인자값 : 출력문자열, 출력구분(I 입력, B 자릿수, N 숫자형, ON 정수형), 객체명
////////////////////////////////////////////////////////////////////////////////
function show_alert(msg, gubun, Obj) {
	if(gubun == "I") {
		alert(msg + required_msg);
		Obj.focus();
	} else if(gubun == "B") {
		alert(msg + byte_msg);
		Obj.focus();
	} else if(gubun == "N") {
		alert(msg + number_msg);
		Obj.focus();
	} else if(gubun == "ON") {
		alert(msg + onlyNumber_msg);
		Obj.focus();
	} else if(gubun == "S") {
		alert(msg + select_msg);
		Obj.focus();
	}
}

///////////////////////////////////////////////////////////////
// 함수명 : 폼 필수항목 체크 함수
///////////////////////////////////////////////////////////////
function formChk(form){
	var cnt = form.elements.length;
	for(i=0; i<cnt; i++){
		if(form.elements[i].must == "Y" && form.elements[i].value ==""){
			alert(form.elements[i].mustName+'은(는) 필수항목입니다.');
			form.elements[i].focus();
			return false;
		}
	}
	return true;
}
///////////////////////////////////////////////////////////////
// 함수명 : 숫자만 입력함수
///////////////////////////////////////////////////////////////

function chkNumber(){
	if(event.keyCode >= 48 && event.keyCode <= 57) 
		{event.returnValue = true;}
	else 
		{event.returnValue = false;}
}
//////////////////////////////////////
// 함수명 : confirm 메세지 출력
// 인자값 : 출력구분(E 수정, D 삭제)
//////////////////////////////////////
function show_confirm(gubun) {
	var returnValue = false;

	if(gubun == "E") {
		returnValue = confirm(edit_msg);
	} else if(gubun == "D") {
		returnValue = confirm(delete_msg);
	}

	return returnValue
}

//////////////////////////////////////////////
// 함수명 : 문자열 자릿수 체크
// 인자값 : 객체명, 제한byte 
//////////////////////////////////////////////
function byteCheck(elementName,count) {
	var tmp_count = 0;
	var intLength = elementName.value.length;

	for (var i = 0; i < intLength; i++) {
		var charCode = elementName.value.charCodeAt(i);
		//한글일 경우
		if (charCode > 128) {
			tmp_count += 2;
		} else {
			tmp_count++;
		}
		
		if(tmp_count > count) break;
	}
	
	if(tmp_count >= count) {
		return false;
	} else {
		return true;
	}
}

//날짜 유효성 검사 시작
///////////////////////////////////////////
// 함수명 : 날짜의 형식 & 유효성 체크 함수
// 인자값 : 날짜값 , 날짜형식
///////////////////////////////////////////
function DateCheck(date, option) {
	var year	= "";
	var mon		= "";
	var day		= "";

	var yearTmp	= "";
	var monTmp	= "";
	var dayTmp	= "";
	var dateTmp	= "";

	var dCheck	= false;
	var number	= /[^0-9]/g;				//숫자이외의 값 정규화		
	
	//숫자이외의 값 제거
	date = date.replace(number,"");

	//날짜형식체크
	dCheck = DateString(date, option);

	//날짜 유효성체크
	if(dCheck == true) {
		year	= date.substring(0,4);
		mon		= date.substring(4,6);

		if(option) {				
			var yymmdd	= new Date(year,mon-1);				
		} else {
			day		= date.substring(6,8);
			var yymmdd	= new Date(year,mon-1,day);

			dayTmp	= yymmdd.getDate();

			if(dayTmp < 10) {
				dayTmp = "0" + dayTmp.toString(10)
			}
		}

		yearTmp	= yymmdd.getYear();
		if(yearTmp < 100) {
			if(yearTmp < 10) {
				yearTmp = "0" + yearTmp.toString(10);
			}
			yearTmp = "19" + yearTmp;
		}

		monTmp	= yymmdd.getMonth();
		monTmp	= monTmp + 1;
		if(monTmp < 10) {
			monTmp = "0" + monTmp.toString(10);
		}

		dateTmp = yearTmp.toString(10) + monTmp.toString(10) + dayTmp.toString(10);

		if(date == dateTmp) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

////////////////////////////////
// 함수명 : 날짜의 형식체크 함수
// 인자값 : 날짜값 , 날짜형식
////////////////////////////////
function DateString(date, option) {
	var dCheck_long		= /^[1-9]{1}[0-9]{3}[0-1]{1}[0-9]{1}[0-3]{1}[0-9]{1}/g;	//YYYYMMDD 정규화
	var dCheck_short	= /^[1-9]{1}[0-9]{3}[0-1]{1}[0-9]{1}/g;					//YYYYMM 정규화		

	//option의 값이 있다면 dCheck_short 정규화 사용
	if(option) {
		if(date.match(dCheck_short)) {
			return true;
		} else {
			return false;
		}
	//option의 값이 없다면 dCheck_short 정규화 사용
	} else {
		if(date.match(dCheck_long)) {
			return true;
		} else {
			return false;
		}
	}
}
//날짜 유효성 검사 끝

//////////////////////////////////////////////////////////////////
// 함수명 : Tab메뉴 이미지 롤오버
// 인자값 : Tab그룹ID, 현재의Tab, 메뉴갯수, 아웃이미지, 오버이미지
//////////////////////////////////////////////////////////////////
function fncTabImg(tmpid1, tmpid2, count, imgSrc1, imgSrc2) {
	var num   = "";
	var imgId = "";
	
	for(i=0; i<count; i++) {
		num = parseInt(i) + 1;
		imgId = tmpid2 + num;
		
		document.getElementById(imgId).src = imgSrc1 + num + ".gif";
	}

	document.getElementById(tmpid1).src = imgSrc2;
}

//////////////////////////////
// 함수명 : 플래시 출력 함수
// 인자값 : 경로, width, hight
//////////////////////////////
function FlashControl(Src, Width, Hight) {
	var strFlash;

	strFlash = "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='" + Width +  "' height='" + Hight + "'>";
	strFlash += "<param name='movie' value='" + Src + "'>";
	strFlash += "<param name='quality' value='high'>";
	strFlash += "<embed src='" + Src + "' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='" + Width +  "' height='" + Hight + "'></embed>";
	strFlash += "</object>";
	
	document.write( strFlash);
}

///////////////////////////////////////////////////////////////
// 함수명 : 이메일
///////////////////////////////////////////////////////////////
	function changeEmail(fName){		
		if (fName.Email3.value != "직접입력") {
			fName.Email2.value = fName.Email3.value;
		//	fName.Email2.style.display = "none";
		} else {
			fName.Email2.style.display = "inline";
			fName.Email2.value = "";
			fName.Email2.focus();
		}

		fName.mailchk.value = 'No';

	}

