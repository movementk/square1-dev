/* ====================================================================================================
	함수명		: getXMLHttpRequest()
	작성목적	: Ajax 객체 생성
==================================================================================================== */
function getXMLHttpRequest() {
	if (window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e)	{
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e1) { return null; }
		}
	} else if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}

var httpRequest = null;



/* ====================================================================================================
	함수명		: sendRequest(url, params, callback, method)
	작성목적	: Ajax 연동 함수
	Parameter :
		url - 페이지 경로
		params - GET = '' / POST = Form Query String
		callback - 콜백함수명 (괄호제외)
		method - GET / POST
==================================================================================================== */
function sendRequest(url, params, callback, method) {
	httpRequest = getXMLHttpRequest();
	var httpMethod = method ? method : 'GET';
	if (httpMethod != 'GET' && httpMethod != 'POST') {
		httpMethod = 'GET';
	}

	var httpParams = (params == null || params == '') ? null : params;
	var httpUrl = url;
	if (httpMethod=='GET' && httpParams != null) {
		httpUrl = httpUrl + "?" + httpParams;
	}

	httpRequest.open(httpMethod, httpUrl, true);
	httpRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = callback;
	httpRequest.send(httpMethod == 'POST' ? httpParams : null);
}



/* ====================================================================================================
	함수명		: getFormStr(form)
	작성목적	: Ajax Post방식 연동
	Parameter :
		form - 폼 객체
==================================================================================================== */
function getFormStr(form) {
	var AjaxLength = form.elements.length;
	var AjaxTypeName, AjaxTagName;
	var AjaxElementName, AjaxElementValue;
	var getstr = "";

	for (i=0; i<AjaxLength; i++) 
	{
		// 타입명, 태그이름, 객체이름, 객체값
		AjaxTypeName = form.elements[i].type.toUpperCase();
		AjaxTagName = form.elements[i].tagName.toUpperCase();
		AjaxElementName = form.elements[i].name;
		AjaxElementValue = form.elements[i].value;

		if (AjaxTypeName == "TEXT" || AjaxTypeName == "PASSWORD" || AjaxTypeName == "TEXTAREA" || AjaxTypeName == "HIDDEN") {
			getstr += AjaxElementName + "=" + encodeURIComponent(escape(AjaxElementValue)) + "&";
		}

		if (AjaxTypeName == "CHECKBOX") {
			if (form.elements[i].checked) {
				getstr += AjaxElementName + "=" + encodeURIComponent(escape(AjaxElementValue)) + "&";
			} else {
				getstr += AjaxElementName + "=&";
			}
		}

		if (AjaxTypeName == "RADIO") {
			if (form.elements[i].checked) {
				getstr += AjaxElementName + "=" + encodeURIComponent(escape(AjaxElementValue)) + "&";
			}
		}

		if (AjaxTypeName == "SELECT-ONE") {
			getstr += AjaxElementName + "=" + encodeURIComponent(escape(AjaxElementValue)) + "&";
		}
	}
	return getstr;
}