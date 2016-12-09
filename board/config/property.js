var imgobj = document.getElementById('bigimg');
function bigview(imgSrc,maxwidth,maxheight){
	imgobj.src=imgSrc;
	if(imgobj.width>maxwidth){
		imgobj.height = imgobj.height*maxwidth/imgobj.width;
		imgobj.width = maxwidth;
	}else if(imgobj.height>maxheight){
		imgobj.width = imgobj.width * maxheight/imgobj.height;
		imgobj.height = maxheight;
	}
}


function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
/*
function board_chk(){
	var f = document.write_form;
	for(i=0;i<f.elements.length;i++){
			if(f.elements[i].must == "Y" && f.elements[i].value == ""){
				alert("must input "+f.elements[i].mustName);
				f.elements[i].focus();
				return;
			}
			if(f.elements[i].url == "Y" && f.elements[i].value.indexOf("http://") == -1){
				var url = f.elements[i].value;
				alert("Link URL에 'http://'가 빠졌습니다.\n자동으로 입력하시겠습니까?");
				f.elements[i].value = "";
				f.elements[i].value = "http://"+url;
				return;
			}
	}
	f.submit();
}
*/
function board_chk(){
	var form = document.MemberForm;

	if(FormCheck(form) == true){
		form.submit();
	} else {
		return;
	}
}

function delete_chk(){
	var form = document.view_form;
	if(!confirm('정말로 삭제하시겠습니까?')) return;
	form.submit();
}
function must_ck(){
	var f = document.write_form;
	for(i=0;i<f.elements.length;i++){
			if(f.elements[i].must == "Y" && f.elements[i].value == ""){
				alert("must input "+f.elements[i].mustName);
				f.elements[i].focus();
				return false;
			}
			if(f.elements[i].url == "Y" && f.elements[i].value.indexOf("http://") == -1){
				var url = f.elements[i].value;
				alert("Link URL에 'http://'가 빠졌습니다.\n자동으로 입력하시겠습니까?");
				f.elements[i].value = "";
				f.elements[i].value = "http://"+url;
				return false;
			}
	}

	return true;
}

function board_list_move(searchVal) {
	location = "?board_code=board_list&"+searchVal;
}


function board_view(idx,searchVal){
		location = "?board_code=board_view&board_idx="+idx+"&"+searchVal;
}

function board_modify(){
	document.modi_form.submit();
}
function board_reple(board_idx,mob,searchVal,ref,restep,relevel){
    location = "?"+searchVal+"&board_code=board_write&board_idx="+board_idx+"&Ref="+ref+"&ReStep="+restep+"&ReLevel="+restep+"&mob="+mob;
}
function board_write(searchVal){
   location = "?board_code=board_write&"+searchVal;
}
function board_del1(){
	if(document.modi_form.upw.value == ""){
		alert("비밀번호를 입력해주세요");
		document.modi_form.upw.focus();
		return;
	}
	if(confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")){
		document.modi_form.action = '/new/board/module/incboard/board_ok.php';
		document.modi_form.board_code.value = 'board_delete';
		document.modi_form.submit();
	}
}
function board_del(){
	
	if(confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")){
		document.modi_form.action = '/new/board/module/incboard/board_ok.php';
		document.modi_form.board_code.value = 'board_delete';
		document.modi_form.submit();
	}
}
function CommentDel(CommentIdx,BoardIdx,searchVal,RePage,ulv,ref,restep,relevel){
   if(confirm("한번 삭제한 자료는 되돌릴 수 없습니다. 정말 삭제하시겠습니까?")){
      location = "/board/module/incboard/comment_ok.php?comment_method=del&CommentIdx="+CommentIdx+"&board_idx="+BoardIdx+"&"+searchVal+"&RePage="+RePage+"&UpLevel="+ulv+"&Ref="+ref+"&ReStep="+restep+"&ReLevel="+relevel;
   }
}
function CommentReple(CommentIdx,ref,restep,relevel,uname,utext){
	//if(confirm(uname+"님의 댓글 '"+utext+"'에 답변하시겠습니까?\n기존 입력내용은 모두 사라집니다.")){
		document.comment_form.Comment.value = "";
		document.getElementById("origin").innerHTML = "원글 : [<strong>"+uname+"</strong>] 내용 : "+utext;
		document.comment_form.cid.value = CommentIdx;
		document.comment_form.Ref.value = ref;
		document.comment_form.ReStep.value = restep;
		document.comment_form.ReLevel.value = relevel
	//}
}

///////////////////////////////////////////클릭위치 좌표값으로 레이어띄우기////////////////////////////////////////////////////
function abspos(e){
    this.x = e.clientX + (document.documentElement.scrollLeft?document.documentElement.scrollLeft:document.body.scrollLeft);
    this.y = e.clientY + (document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop);
    return this;
}


function itemClick(e,str,str2){
    var ex_obj = document.getElementById(str);
    if(!e) e = window.Event;
    pos = abspos(e);
    ex_obj.style.left = pos.x+"px";
    ex_obj.style.top = (pos.y+10)+"px";

	//ex_obj.style.display = ex_obj.style.display=='none'?'block':'none';
	showLayer();
	
	if(str2 != '' && ex_obj.style.display == 'block'){
		document.memo_form.uname.value = str2;
		document.memo_form.tn.value = "3";
	}
	
}
 function showLayer(){
	 clickAreaCheck = true;
	 divDisplay("pop_memo", 'block');
 }


function divDisplay(id, act){
	document.getElementById(id).style.display = act;
}

function hideLayer(){
	if (document.getElementById("pop_memo"))
		divDisplay ("pop_memo", 'none');
}

var clickAreaCheck = false;
document.onclick = function(){
	if (!clickAreaCheck) 
		hideLayer();
	else 
		clickAreaCheck = false;
}
///////////////////////////////////////////클릭위치 좌표값으로 레이어띄우기////////////////////////////////////////////////////





/*/////////////////////////////////////////////주민번호 체크루틴 //////////////////////////////////////////////////////////////
주민등록번호 체크 로직

1. 주민등록번호의 앞 6자리의 수에 처음부터 차례대로 2,3,4,5,6,7 을 곱한다. 그 다음, 뒤 7자리의 수에 마지막 자리만 제외하고 차례대로 8,9,2,3,4,5 를 곱한다.

2. 이렇게 곱한 각 자리의 수들을 모두 더한다.

3. 모두 더한 수를 11로 나눈 나머지를 구한다.

4. 이 나머지를 11에서 뺀다.

5. 이렇게 뺀 수가 두 자릿수이면, 즉 10보다 크면 다시 11로 나누어 나머지 값을 구한다.

6. 이렇게 해서 나온 최종 값을 주민등록번호의 마지막 자리 수와 비교해서 같으면 유효한 번호이고 다르면 잘못된 값이다.

 *////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function JuminChk(juminno,frm) {

	if(juminno=="" || juminno==null) {
		alert("주민등록번호를 적어주세요.");
		frm.Jumin1.value = "";
		frm.Jumin1.focus();
		return false;
	}
	
	var pattern = /(^[0-9]{13}$)/; 
	if (!pattern.test(juminno)) 
	{ 
	   alert("주민등록번호를 13자리 숫자로 입력하십시오.\n");
	   frm.Jumin1.value = "";
	   frm.Jumin2.value = "";
	   frm.Jumin1.focus();
	   return false;
	} 
	else 
	{
		var sum_1 = 0;
		var sum_2 = 0;
		var at=0;
		var juminno= juminno;
		sum_1 = (juminno.charAt(0)*2)+
				(juminno.charAt(1)*3)+
				(juminno.charAt(2)*4)+
				(juminno.charAt(3)*5)+
				(juminno.charAt(4)*6)+
				(juminno.charAt(5)*7)+
				(juminno.charAt(6)*8)+
				(juminno.charAt(7)*9)+
				(juminno.charAt(8)*2)+
				(juminno.charAt(9)*3)+
				(juminno.charAt(10)*4)+
				(juminno.charAt(11)*5);
		sum_2=sum_1 % 11;

		if (sum_2 == 0) 
			at = 10;
		else 
		{
			if (sum_2 == 1) 
				at = 11;
			else 
				at = sum_2;
		}
		att = 11 - at;
		// 1800 년대에 태어나신 분들은 남자, 여자의 구분이 9, 0 이라는 
		// 얘기를 들은적이 있는데 그렇다면 아래의 구문은 오류이다.
		// 하지만... 100살넘은 분들이 주민등록번호를 과연 입력해볼까?
		if (juminno.charAt(12) != att || 
			juminno.substr(2,2) < '01' ||
			juminno.substr(2,2) > '12' ||
			juminno.substr(4,2) < '01' ||
			juminno.substr(4,2) > '31' ||
			juminno.charAt(6) > 4) 
		{
		   alert("올바른 주민등록번호가 아닙니다.\n");
		   return false;
		}

	}
return true;

	/*
	if(juminno=="" || juminno==null) {
		alert("주민등록번호를 적어주세요.");
		frm.Jumin1.value = "";
		frm.Jumin1.focus();
		return false;
	}

	if(juminno.length!=13){
		alert("주민등록번호의 자리수가 맞지않습니다.");
		frm.Jumin1.value = "";
		frm.Jumin2.value = "";
		frm.Jumin1.focus();
		return false;
	}
	
	var jumin1 = juminno.substr(0,6);
	var jumin2 = juminno.substr(6,7);
	var yy     = jumin1.substr(0,2);        // 년도
	var mm     = jumin1.substr(2,2);        // 월
	var dd     = jumin1.substr(4,2);        // 일
	var genda  = jumin2.substr(0,1);        // 성별
	var msg, ss, cc;
	
	// 숫자가 아닌 것을 입력한 경우
	if (!isNumeric(jumin1)) {
		alert("주민등록번호 앞자리를 숫자로 입력하세요.");
		frm.Jumin1.value = "";
		frm.Jumin1.focus();
		return false;
	}
	
	// 길이가 6이 아닌 경우
	if (jumin1.length != 6) {
		alert("주민등록번호 앞자리의 길이가 짧습니다. 다시 입력하세요.");
		frm.Jumin1.value = "";
		frm.Jumin1.focus();
		return false;
	}
	
	// 첫번째 자료에서 연월일(YYMMDD) 형식 중 기본 구성 검사
	if (yy < "00" || yy > "99" || mm < "01" || mm > "12" || dd < "01" || dd > "31") {
		alert("주민등록번호 앞자리의 형식이 맞지 않습니다. 다시 입력하세요.");
		frm.Jumin1.value = "";
		frm.Jumin1.focus();
		return false;
	}
	
	// 숫자가 아닌 것을 입력한 경우
	if (!isNumeric(jumin2)) {
		alert("주민등록번호 뒷자리를 숫자로 입력하세요.");
		frm.Jumin2.value = "";
		frm.Jumin2.focus();
		return false;
	}
	
	// 길이가 7이 아닌 경우
	if (jumin2.length != 7) {
		alert("주민등록번호 뒷자리의 길이가 짧습니다. 다시 입력하세요.");
		frm.Jumin2.value = "";
		frm.Jumin2.focus();
		return false;
	}
	
	// 성별부분이 1 ~ 4 가 아닌 경우
	if (genda < "1" || genda > "4") {
		alert("성별이 올바르지 않습니다. 주민등록번호 뒷자리를 다시 입력하세요.");
		frm.Jumin2.value = "";
		frm.Jumin2.focus();
		return false;
	}
	
	// 연도 계산 - 1 또는 2: 1900년대, 3 또는 4: 2000년대
	cc = (genda == "1" || genda == "2") ? "19" : "20";
	
	// 첫번째 자료에서 연월일(YYMMDD) 형식 중 날짜 형식 검사
	if (isValidDate(cc+yy+mm+dd) == false) {
		alert("주민등록번호 앞자리를 다시 입력하세요.");
		frm.Jumin1.value = "";
		frm.Jumin1.focus();
		return false;
	}
	
	// Check Digit 검사
	if (!isSSN(jumin1, jumin2)) {
		alert("입력한 주민등록번호를 검토한 후, 다시 입력하세요.");
		frm.Jumin1.value = "";
		frm.Jumin2.value = "";
		frm.Jumin1.focus();

		return false;
	}
	
	return true;
	*/
}
///////////////////////////////////////////////주민번호 체크루틴 //////////////////////////////////////////////////////////////




//////////////////////////////////////////////// 주민번호 앞자리 날짜형태 체크 ////////////////////////////////////////////////
function isValidDate(iDate) {
	if( iDate.length != 8 ) {
		return false;
	}
	
	oDate = new Date();
	oDate.setFullYear(iDate.substring(0, 4));
	oDate.setMonth(parseInt(iDate.substring(4, 6)) - 1);
	oDate.setDate(iDate.substring(6));
	
	if( oDate.getFullYear() != iDate.substring(0, 4) || oDate.getMonth() + 1 != iDate.substring(4, 6) || oDate.getDate() != iDate.substring(6) ){
		return false;
	}
	
	return true;
}
//////////////////////////////////////////////// 주민번호 앞자리 날짜형태 체크 ////////////////////////////////////////////////






///////////////////////////////////////////// 숫자인지 검사 ///////////////////////////////////////////////////////////////////
function isNumeric(s) { 
	for (i=0; i<s.length; i++) { 
		c = s.substr(i, 1); 
		if (c < "0" || c > "9") return false; 
	} 
	
	return true; 
}
///////////////////////////////////////////// 숫자인지 검사 ///////////////////////////////////////////////////////////////////





///////////////////////////////////////// 한글인지 검사2 (자음, 모음만 있는 한글도 가능)///////////////////////////////////////
function Hangul(fld){
	for(i = 0; i < fld.value.length; i++){
		if(!((fld.value.charCodeAt(i) > 0x3130 && fld.value.charCodeAt(i) < 0x318F) || (fld.value.charCodeAt(i) >= 0xAC00 && fld.value.charCodeAt(i) <= 0XD7A3))){
			alert("한글만 입력해주세요");
			fld.value = "";
			fld.focus();
			return false;
		}
	}
	return true;
}
///////////////////////////////////////// 한글인지 검사2 (자음, 모음만 있는 한글도 가능)///////////////////////////////////////





/////////////////////////////////////////////// 주민번호 유효성 검사 //////////////////////////////////////////////////////////
function isSSN(s1, s2) {
	n = 2;
	sum = 0;
	
	for (i=0; i<s1.length; i++){
		sum += parseInt(s1.substr(i, 1)) * n++;
	}
	
	for (i=0; i<s2.length-1; i++) {
		sum += parseInt(s2.substr(i, 1)) * n++;
		if (n == 10) n = 2;
	}
	
	c = 11 - sum % 11;
	if (c == 11) c = 1;
	if (c == 10) c = 0;
	if (c != parseInt(s2.substr(6, 1))){
		return false;
	} else {
		return true;
	}
}
/////////////////////////////////////////////// 주민번호 유효성 검사 //////////////////////////////////////////////////////////




//////////////////////////////////////////////// 영문, 숫자, _ 만 가능 //////////////////////////////////////////////////////////
function MemberIdChk(fld){
	var FileCheck = new RegExp('[^a-zA-Z0-9_./\-]');
	var temp;
	var msglen;
	var maxlen;
	maxlen = fld.value.length;
	msglen = maxlen;
	var value = fld.value;
	
	l =  fld.value.length;
	tmpstr = "" ;
	if (l == 0){
		value = maxlen;
	} else {
		for(k=0;k<l;k++){
			temp = value.charAt(k);
			if (FileCheck.test(temp)){
				fld.value= tmpstr;
				alert("영문 소문자와 숫자, 기호 \"_\" 만 입력 가능합니다.");
				break;
			} else {
				msglen--;
			}
			
			tmpstr += temp;
		}
	}
}

//////////////////////////////////////////////// 영문, 숫자, _ 만 가능 //////////////////////////////////////////////////////////


function nextFocus(sFormName,sNow,sNext){
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

function win_open(url, name, option)
{
	var popup = window.open(url, name, option);
	popup.focus();
}

// 우편번호 창
function win_zip(frm_name, frm_zip1, frm_zip2, frm_addr1, frm_addr2, path)
{
	url = path + "/zipcode.php?frm_name="+frm_name+"&frm_zip1="+frm_zip1+"&frm_zip2="+frm_zip2+"&frm_addr1="+frm_addr1+"&frm_addr2="+frm_addr2;
	win_open(url, "winZip", "left=50,top=50,width=350,height=350,scrollbars=1");
}