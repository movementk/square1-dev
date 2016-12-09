/* ====================================================================================================
	js(명)		: 폼체크 통합 유틸리티 JavaScript
	설명			: 폼체크유효성 검사하는 통합 자바스크립트 함수
	파일명		: /js/FormCheck.js
	작성자		: 박세민
	작성일		: 2009-07-07
	작성폰트	: Verdana/ Regular/ 8
==================================================================================================== */



/* ====================================================================================================
	정규패턴식 변수정의
==================================================================================================== */
var OnlyNumber = /^[0-9]+$/
var OnlyEnglish = /^[a-z|A-Z]+$/
var OnlyKorea = /^[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]+$/
var EmailCheck1 = /^([a-z]([a-z|0-9|_]{3,19})@([a-z|A-Z|0-9]{2,20})\.([a-z|A-Z]{2,5}))+$/
var EmailCheck2 = /^([a-z]([a-z|0-9|_]{3,19})@([a-z|A-Z|0-9]{2,20})\.([a-z|A-Z]{2,10})\.([a-z|A-Z]{2,5}))+$/
var IdCheck = /^([a-z]([a-z|0-9|_]{3,19}))+$/
var NicNameCheck =/^([가-힣a-zA-Z0-9_-~`!@#$^&*=+]{2,20})+$/
var EmailAfterCheck1 = /^(([a-z|0-9]{2,20})\.([a-z|A-Z]{2,10})\.([a-z|A-Z]{2,5}))+$/
var EmailAfterCheck2 = /^(([a-z|0-9]{2,20})\.([a-z|A-Z]{2,5}))+$/
var InjectionCheck = /\/\*|\*\/|%|@variable|xp_cmdshell|xp_stratmail|xp_sendmail|xp_grantlogin|xp_makewebtask|xp_dirtree|db_owner|xp_|sp_|db_|union|sysobjects|is_srvrolemember|cookie|shutdown|alter|\.js|script|create|declare|select|insert|drop|update|delete|truncate|cmdshell|execmaster|exec|netlocalgroupadministratthens|netuser|kill|xmp|count\(|asc\(|mid\(|char\(|varchar\(|db_name\(\)|openrowset\(\)/

var NicTypeMsg = "_-~`!@#$^&*=+";
var ImageTypeMsg = "gif, jpg, jpeg, png";
var ImageType = /\.(gif|jpg|jpeg|png)$/
var MovieTypeMsg = "wmv, asf";
var MovieType = /\.(wmv|asf)$/
var WordTypeMsg = "ppt, xls, csv, hwp, doc, txt";
var WordType = /\.(ppt|xls|csv|hwp|doc|txt)$/
var ComTypeMsg = "alz, zip";
var ComType = /\.(alz|zip)$/
var SwfTypeMsg = "swf";
var SwfType = /\.(swf)$/
var InSTypeMsg = "gif, jpg, jpeg, png, swf";
var InSType = /\.(gif|jpg|jpeg|png|swf)$/

// 주민번호 앞자리 저장 변수
var JuminFront = "";

function formatnumber(v1,v2){  
    var str = new Array();   
    v1 = String(v1);   
    for(var i=1;i<=v1.length;i++){   
        if(i % v2) str[v1.length-i] = v1.charAt(v1.length-i);   
        else str[v1.length-i] = ','+v1.charAt(v1.length-i);   
    }  
    return str.join('').replace(/^,/,'');   
}  


/* ====================================================================================================
	함수명		: ElementPrototype(CheckElement)
	작성목적	: 객체속성 체크함수
	Parameter :
		CheckElement - 해당객체

		Element - 객체
		TypeName - 객체타입
		TagName - 객체태그
		ElementName - 객체이름
		ElementValue - 객체값
==================================================================================================== */
function ElementPrototype(CheckElement)
{
	// 라디오박스/체크박스 = true
	if (CheckElement.length > 1 && ObjectYN(CheckElement.options) == false)
	{
		return {
			Element : CheckElement[0], 
			TypeName : CheckElement[0].type.toUpperCase(), 
			TagName : CheckElement[0].tagName.toUpperCase(), 
			ElementName : CheckElement[0].name, 
			ElementValue : CheckElement[0].value 
		}
	}
	else
	{
		return {
			Element : CheckElement, 
			TypeName : CheckElement.type.toUpperCase(), 
			TagName : CheckElement.tagName.toUpperCase(), 
			ElementName : CheckElement.name, 
			ElementValue : CheckElement.value 
		}
	}
}



/* ====================================================================================================
	함수명		: ElementAttribute(CheckElement)
	작성목적	: 폼안의 어트리뷰트 체크함수
	Parameter :
		CheckElement - 해당객체
==================================================================================================== */
function ElementAttribute(CheckElement)
{
	// 경고창에 표시될 객체명
	if (ObjectYN(CheckElement.getAttribute("title")) == true) {
		AL_Title = CheckElement.getAttribute("title");
	} else {
		AL_Title = "";
	}

	return {
		AL_Title : AL_Title,																// 객체명

		// 유효성 체크
		AL_Exp : CheckElement.getAttribute("exp"),							// 필수입력
		AL_Num : CheckElement.getAttribute("num"),						// 숫자만입력
		AL_Eng : CheckElement.getAttribute("eng"),							// 영어만입력
		AL_Kor : CheckElement.getAttribute("kor"),							// 한글만입력
		AL_Uid : CheckElement.getAttribute("uid"),							// ID형식 체크
		AL_Nic : CheckElement.getAttribute("nic"),							// 닉네임형식 체크
		AL_Inj : CheckElement.getAttribute("inj"),							// 인젝션공격성 문자열 체크

		// 이메일 체크
		AL_Eml : CheckElement.getAttribute("eml"),							// E-mail 형식 체크
		AL_Ela : CheckElement.getAttribute("ela"),							// E-mail 뒷부분 형식 체크

		// 파일유효성 체크
		AL_Img : CheckElement.getAttribute("img"),							// 이미지만 업로드
		AL_Mov : CheckElement.getAttribute("mov"),						// 영상만 업로드
		AL_Wor : CheckElement.getAttribute("wor"),							// 문서만 업로드
		AL_Com : CheckElement.getAttribute("com"),						// 압축파일만 업로드
		AL_Swf : CheckElement.getAttribute("swf"),							// 플래시파일만 업로드
		AL_Ins : CheckElement.getAttribute("ins"),							// 이미지/플래시파일만 업로드

		// 에디터 체크
		AL_Edexp : CheckElement.getAttribute("edexp"),					// 에디터 필수입력
		AL_Edinj : CheckElement.getAttribute("edinj"),						// 에디터 인젝션공격성 문자열 체크

		// 주민등록번호 체크
		AL_Ju1 : CheckElement.getAttribute("ju1"),	 						// 주민등록번호 앞자리 체크
		AL_Ju2 : CheckElement.getAttribute("ju2"),							// 주민등록번호 뒷자리 체크
		AL_Jum : CheckElement.getAttribute("jum")							// 주빈등록번호 체크
	}
}



/* ====================================================================================================
	함수명		: ObjectYN(obj)
	작성목적	: 객체가 있는지 검사
	Parameter :
		obj - 검사할 객체
==================================================================================================== */
function ObjectYN(obj)
{
	if (typeof(obj) != "undefined" && obj != "" && obj != null) {
		return true;
	} else {
		return false;
	}
}



/* ====================================================================================================
	함수명		: AttYN(obj)
	작성목적	: 객체가 있는지 검사 - 어트리뷰트 전용
	Parameter :
		obj - 검사할 객체
==================================================================================================== */
function AttYN(obj)
{
	if (typeof(obj) != "undefined" && obj != null) {
		return true;
	} else {
		return false;
	}
}



/* ====================================================================================================
	함수명		: strTrim(Field)
	작성목적	: 앞, 뒤 공백 제거
	Parameter :
		Field - 객체 값
==================================================================================================== */
function strTrim(Field)
{
	Field = Field.replace(/(^\s*)|(\s*$)/g, "")
//	Field = Field.replace("<P>&nbsp;</P>", "")
	return Field;
}



/* ====================================================================================================
	함수명		: FormCheck(form)
	작성목적	: 폼안의 객체검사
	Parameter :
		form - 검사할 폼
	사용법 : 
		if(FormCheck(frm) == true)
		{
			frm.action = "액션페이지";
			frm.submit();
		}
==================================================================================================== */
function FormCheck(form)
{
	var obj, att, f;
	var ElementLength = form.elements.length;

	for (f=0; f<ElementLength; f++)
	{
		//alert(form.elements[f].type);
		// 객체속성 체크함수
		obj = ElementPrototype(form.elements[f]);

		// 객체 어트리뷰트 체크함수
		att = ElementAttribute(obj.Element);

		// 유효성 체크
		if (AttYN(att.AL_Exp) == true) { if (Fn_Exp(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Num) == true) { if (Fn_Num(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Eng) == true) { if (Fn_Eng(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Kor) == true) { if (Fn_Kor(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Uid) == true) { if (Fn_Uid(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Nic) == true) { if (Fn_Nic(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Inj) == true) { if (Fn_Inj(obj.Element, att.AL_Title) == false) { return false; } }

		// 이메일 체크
		if (AttYN(att.AL_Eml) == true) { if (Fn_Eml(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Ela) == true) { if (Fn_Ela(obj.Element, att.AL_Title) == false) { return false; } }

		// 파일유효성 체크
		if (AttYN(att.AL_Img) == true) { if (Fn_Img(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Mov) == true) { if (Fn_Mov(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Wor) == true) { if (Fn_Wor(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Com) == true) { if (Fn_Com(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Swf) == true) { if (Fn_Swf(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Ins) == true) { if (Fn_Ins(obj.Element, att.AL_Title) == false) { return false; } }

		// 에디터 체크
		if (AttYN(att.AL_Edexp) == true) { if (Fn_Edexp(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Edinj) == true) { if (Fn_Edinj(obj.Element, att.AL_Title) == false) { return false; } }

		// 주민등록번호 체크
		if (AttYN(att.AL_Ju1) == true) { if (Fn_Ju1(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Ju2) == true) { if (Fn_Ju2(obj.Element, att.AL_Title) == false) { return false; } }
		if (AttYN(att.AL_Jum) == true) { if (Fn_Jum(obj.Element, att.AL_Title) == false) { return false; } }
	}

	return true;
}



/* ====================================================================================================
	함수명		: FormCheckSub(form, gb)
	작성목적	: 폼안의 객체검사
	Parameter :
		form - 검사할 폼
	사용법 : 
		if(FormCheckSub(폼.이름, "구분자", "메세지") == false){ return false; }
==================================================================================================== */
function FormCheckSub(chk, gb, msg)
{
	// 유효성 체크
	if (gb == "exp") { if (Fn_Exp(chk, msg) == false) { return false; } }
	if (gb == "num") { if (Fn_Num(chk, msg) == false) { return false; } }
	if (gb == "eng") { if (Fn_Eng(chk, msg) == false) { return false; } }
	if (gb == "kor") { if (Fn_Kor(chk, msg) == false) { return false; } }
	if (gb == "uid") { if (Fn_Uid(chk, msg) == false) { return false; } }
	if (gb == "nic") { if (Fn_Nic(chk, msg) == false) { return false; } }
	if (gb == "inj") { if (Fn_Inj(chk, msg) == false) { return false; } }

	// 이메일 체크
	if (gb == "eml") { if (Fn_Eml(chk, msg) == false) { return false; } }
	if (gb == "ela") { if (Fn_Ela(chk, msg) == false) { return false; } }

	// 파일유효성 체크
	if (gb == "img") { if (Fn_Img(chk, msg) == false) { return false; } }
	if (gb == "mov") { if (Fn_Mov(chk, msg) == false) { return false; } }
	if (gb == "wor") { if (Fn_Wor(chk, msg) == false) { return false; } }
	if (gb == "com") { if (Fn_Com(chk, msg) == false) { return false; } }
	if (gb == "swf") { if (Fn_Swf(chk, msg) == false) { return false; } }
	if (gb == "ins") { if (Fn_Ins(chk, msg) == false) { return false; } }

	// 에디터 체크
	if (gb == "edexp") { if (Fn_Edexp(chk, msg) == false) { return false; } }
	if (gb == "edinj") { if (Fn_Edinj(chk, msg) == false) { return false; } }

	// 주민등록번호 체크
	if (gb == "ju1") { if (Fn_Ju1(chk, msg) == false) { return false; } }
	if (gb == "ju2") { if (Fn_Ju2(chk, msg) == false) { return false; } }
	if (gb == "jum") { if (Fn_Jum(chk, msg) == false) { return false; } }
}



/* ====================================================================================================
	함수명		: Fn_Exp(CheckElement, AlertMsg)
	작성목적	: 필수입력 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Exp(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
	{
		if (strTrim(obj.ElementValue) == "" || strTrim(obj.ElementValue) == "<p>&nbsp;</p>" || strTrim(obj.ElementValue) == "&nbsp;")
		{
			if (obj.TypeName == "HIDDEN")
			{
				alert("["+ AlertMsg +"] 값이 없습니다.\n\n관리자에게 문의해주세요.");
				return false;
			}
			else
			{
				alert("["+ AlertMsg +"] 필수 입력 사항입니다.");
				obj.Element.focus();
				return false;
			}
		}
	}

	else if (obj.TypeName == "FILE")
	{
		if (strTrim(obj.ElementValue) == "")
		{
			alert("["+ AlertMsg +"] 필수등록사항");
			obj.Element.focus();
			return false;
		}
	}

	else if (obj.TypeName == "SELECT-ONE")
	{
		if (strTrim(obj.ElementValue) == "")
		{
			alert("["+ AlertMsg +"] 필수선택사항");
			obj.Element.focus();
			return false;
		}
	}

	else if (obj.TypeName == "RADIO")
	{
		var Radio_YN = "N";
		var RadioName = document.getElementsByName(obj.ElementName);

		if (ObjectYN(RadioName.length) == true) 
		{
			for (r=0; r<RadioName.length; r++)
			{
				if (RadioName[r].checked == true){
					Radio_YN = "Y";
				}
			}
			if (Radio_YN == "N")
			{
				alert("["+ AlertMsg +"] 필수선택사항");
				RadioName[0].focus();
				return false;
			}
		}
	}

	else if (obj.TypeName == "CHECKBOX")
	{
		var CheckBox_YN = "N";
		var CheckBoxName = document.getElementsByName(obj.ElementName);

		if (ObjectYN(CheckBoxName.length) == true) 
		{
			for (c=0; c<CheckBoxName.length; c++)
			{
				if (CheckBoxName[c].checked == true){
					CheckBox_YN = "Y";
				}
			}
			if (CheckBox_YN == "N")
			{
				alert("["+ AlertMsg +"] 필수선택사항");
				CheckBoxName[0].focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Num(CheckElement, AlertMsg)
	작성목적	: 숫자 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Num(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (OnlyNumber.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 숫자만 입력하세요");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Eng(CheckElement, AlertMsg)
	작성목적	: 영어 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Eng(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (OnlyEnglish.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 영문 대/소 문자만 입력하세요");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Kor(CheckElement, AlertMsg)
	작성목적	: 한글 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Kor(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (OnlyKorea.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 한글만입력");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Uid(CheckElement, AlertMsg)
	작성목적	: ID 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Uid(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (IdCheck.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.\n\n소문자만 입력해 주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Nic(CheckElement, AlertMsg)
	작성목적	: 닉네임 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Nic(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (NicNameCheck.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 형식은\n["+ NicTypeMsg +"]\n특수문자만 허용됩니다.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Inj(CheckElement, AlertMsg)
	작성목적	: 인젝션공격성 문자열 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Inj(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (InjectionCheck.test(obj.ElementValue.toLowerCase()) == true)
			{
				alert("["+ AlertMsg +"] 형식에\n["+ obj.ElementValue.toLowerCase().match(InjectionCheck) +"]\n문자는 입력할수없습니다.");
				// obj.Element.value = obj.ElementValue.replace(obj.ElementValue.match(InjectionCheck), "");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Eml(CheckElement, AlertMsg)
	작성목적	: Email 전체 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Eml(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (EmailCheck1.test(obj.ElementValue) == false && EmailCheck2.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Ela(CheckElement, AlertMsg)
	작성목적	: Email 뒷부분 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Ela(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (EmailAfterCheck1.test(obj.ElementValue) == false && EmailAfterCheck2.test(obj.ElementValue) == false)
			{
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Img(CheckElement, AlertMsg)
	작성목적	: 이미지파일 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Img(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "FILE")
		{
			if (ImageType.test(obj.ElementValue.toLowerCase()) == false)
			{
				alert("["+ AlertMsg +"] 파일은\n["+ ImageTypeMsg +"]\n확장자파일만 업로드해주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Mov(CheckElement, AlertMsg)
	작성목적	: 동영상파일 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Mov(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "FILE")
		{
			if (MovieType.test(obj.ElementValue.toLowerCase()) == false)
			{
				alert("["+ AlertMsg +"] 파일은\n["+ MovieTypeMsg +"]\n확장자파일만 업로드해주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Wor(CheckElement, AlertMsg)
	작성목적	: 문서파일 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Wor(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "FILE")
		{
			if (WordType.test(obj.ElementValue.toLowerCase()) == false)
			{
				alert("["+ AlertMsg +"] 파일은\n["+ WordTypeMsg +"]\n확장자파일만 업로드해주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Com(CheckElement, AlertMsg)
	작성목적	: 압축파일 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Com(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "FILE")
		{
			if (ComType.test(obj.ElementValue.toLowerCase()) == false)
			{
				alert("["+ AlertMsg +"] 파일은\n["+ ComTypeMsg +"]\n확장자파일만 업로드해주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Swf(CheckElement, AlertMsg)
	작성목적	: 플래시파일 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Swf(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "FILE")
		{
			if (SwfType.test(obj.ElementValue.toLowerCase()) == false)
			{
				alert("["+ AlertMsg +"] 파일은\n["+ SwfTypeMsg +"]\n확장자파일만 업로드해주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Ins(CheckElement, AlertMsg)
	작성목적	: 이미지/플래시파일 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Ins(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "FILE")
		{
			if (InSType.test(obj.ElementValue.toLowerCase()) == false)
			{
				alert("["+ AlertMsg +"] 파일은\n["+ InSTypeMsg +"]\n확장자파일만 업로드해주세요.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Edexp(CheckElement, AlertMsg)
	작성목적	: 에디터 체크함수
	Parameter :
		CheckElement - 해당객체/ 에디터 객체이름
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Edexp(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 에디터 객체값 다시 정의
	obj.ElementValue = eval(obj.ElementName +".getHtml()");

	// 폼검사
	if (strTrim(obj.ElementValue) == "" || strTrim(obj.ElementValue) == "<P>&nbsp;</P>" || strTrim(obj.ElementValue) == "&nbsp;")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			alert("["+ AlertMsg +"] 필수입력사항");
			// obj.Element.focus();
			return false;
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Edinj(CheckElement, AlertMsg)
	작성목적	: 에디터 인젝션 체크함수
	Parameter :
		CheckElement - 해당객체/ 에디터 객체이름
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Edinj(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 에디터 객체값 다시 정의
	obj.ElementValue = eval(obj.ElementName +".getHtml()");

	// 폼검사
	if (strTrim(obj.ElementValue) != "" && strTrim(obj.ElementValue) != "<P>&nbsp;</P>" || strTrim(obj.ElementValue) == "&nbsp;")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if (InjectionCheck.test(obj.ElementValue.toLowerCase()) == true)
			{
				alert("["+ AlertMsg +"] 형식에\n["+ obj.ElementValue.toLowerCase().match(InjectionCheck) +"]\n문자는 입력할수없습니다.");
				// obj.Element.value = obj.ElementValue.replace(obj.ElementValue.match(InjectionCheck), "");
				// obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Ju1(CheckElement, AlertMsg)
	작성목적	: 주민등록번호 앞자리 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Ju1(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if(FormCheckSub(CheckElement, "num", AlertMsg) == false)
			{ 
				return false;
			}

			if (strTrim(obj.ElementValue).length != 6) {
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
				obj.Element.focus();
				return false;
			}
		}
	}

	JuminFront = obj.ElementValue;

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Ju2(CheckElement, AlertMsg)
	작성목적	: 주민등록번호 뒷자리 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Ju2(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if(FormCheckSub(CheckElement, "num", AlertMsg) == false)
			{ 
				return false;
			}

			if (strTrim(obj.ElementValue).length != 7)
			{
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
				obj.Element.focus();
				return false;
			}

			if (strTrim(JuminFront) != "" && strTrim(obj.ElementValue) != "")
			{
				if (JuminNumberCheck(JuminFront, obj.ElementValue) == true)
				{
					alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
					obj.Element.focus();
					return false;
				}
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Jum(CheckElement, AlertMsg)
	작성목적	: 주민등록번호 전체 체크함수
	Parameter :
		CheckElement - 해당객체
		AlertMsg - 경고창 내용
==================================================================================================== */
function Fn_Jum(CheckElement, AlertMsg)
{
	// 객체속성 체크함수
	var obj = ElementPrototype(CheckElement);

	// 폼검사
	if (strTrim(obj.ElementValue) != "")
	{
		if (obj.TypeName == "TEXT" || obj.TypeName == "PASSWORD" || obj.TypeName == "TEXTAREA" || obj.TypeName == "HIDDEN")
		{
			if(FormCheckSub(CheckElement, "num", AlertMsg) == false)
			{ 
				return false;
			}

			if (strTrim(obj.ElementValue).length != 13)
			{
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
				obj.Element.focus();
				return false;
			}

			if (JuminNumberCheck(obj.ElementValue.substring(0, 6), obj.ElementValue.substring(6, 13)) == true)
			{
				alert("["+ AlertMsg +"] 형식이 올바르지않습니다.");
				obj.Element.focus();
				return false;
			}
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: JuminNumberCheck(strJumin1, strJumin2)
	작성목적	: 주민등록번호 유효성 검사
	Parameter :
		strJumin1 - 주민등록번호 앞자리
		strJumin2 - 주민등록번호 뒷자리
==================================================================================================== */
function JuminNumberCheck(strJumin1, strJumin2)
{
	var JuminNumber = strJumin1 + strJumin2;

	ju = new Array(13);
	for (var i=0; i<13; i++)
	{
		ju[i] = parseInt(JuminNumber.charAt(i));
	}

	var jn = ju[0]*2 + ju[1]*3 + ju[2]*4 + ju[3]*5 + ju[4]*6 + ju[5]*7 + ju[6]*8 + ju[7]*9 + ju[8]*2 + ju[9]*3 + ju[10]*4 + ju[11]*5;
	var jn = jn % 11;
	var re = 11 - jn;

	if(re > 9) { re = re % 10; }
	if(re != ju[12]) 
		{ return true; } //올바르지 않은 번호
	else 
		{ return false; }	//올바른 번호
}



/* ====================================================================================================
	함수명		: Fn_Fyn(CheckElement1, CheckElement2, AlertMsg)
	작성목적	: 업로드파일이 없을때 체크함수
	Parameter :
		CheckElement1 - 업로드파일 객체
		CheckElement2 - 업로드파일이 없을때 체크객체
		AlertMsg - 경고창 내용
	사용법 : 
		if (Fn_Fyn(폼.이름, 폼.이름, "메세지") == false) { return false; }
==================================================================================================== */
function Fn_Fyn(CheckElement1, CheckElement2, AlertMsg)
{
	if (strTrim(CheckElement1.value) == "")
	{
		if (strTrim(CheckElement2.value) == "")
		{
			if(FormCheckSub(CheckElement2, "exp", AlertMsg) == false) { return false; }
		}
	}

	return true;
}



/* ====================================================================================================
	함수명		: Fn_Tpt(CheckElement1, CheckElement2, AlertMsg)
	작성목적	: 객체1/객체2 비교함수 (서로 같아야한다)
	Parameter :
		CheckElement1 - 비교객체1
		CheckElement2 - 비교객체2
		AlertMsg - 경고창 내용
	사용법 : 
		if (Fn_Tpt(폼.이름, 폼.이름, "메세지") == false) { return false; }
==================================================================================================== */
function Fn_Tpt(CheckElement1, CheckElement2, AlertMsg)
{
	if (strTrim(CheckElement1.value) != "" && strTrim(CheckElement2.value) != "")
	{
		if (CheckElement1.value != CheckElement2.value)
		{
			alert("["+ AlertMsg +"] 서로 일치하지않습니다.");
			CheckElement1.focus();
			return false;
		}
	}

	return true;
}

function formatnumber(v1,v2){  
    var str = new Array();   
    v1 = String(v1);   
    for(var i=1;i<=v1.length;i++){   
        if(i % v2) str[v1.length-i] = v1.charAt(v1.length-i);   
        else str[v1.length-i] = ','+v1.charAt(v1.length-i);   
    }  
    return str.join('').replace(/^,/,'');   
}
