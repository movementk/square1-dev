/* ====================================================================================================
	�Լ���		: getXMLHttpRequest()
	�ۼ�����	: Ajax ��ü ����
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
	�Լ���		: sendRequest(url, params, callback, method)
	�ۼ�����	: Ajax ���� �Լ�
	Parameter :
		url - ������ ���
		params - GET = '' / POST = Form Query String
		callback - �ݹ��Լ��� (��ȣ����)
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
	�Լ���		: getFormStr(form)
	�ۼ�����	: Ajax Post��� ����
	Parameter :
		form - �� ��ü
==================================================================================================== */
function getFormStr(form) {
	var AjaxLength = form.elements.length;
	var AjaxTypeName, AjaxTagName;
	var AjaxElementName, AjaxElementValue;
	var getstr = "";

	for (i=0; i<AjaxLength; i++) 
	{
		// Ÿ�Ը�, �±��̸�, ��ü�̸�, ��ü��
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