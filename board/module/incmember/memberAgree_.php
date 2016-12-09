<script src="../../config/userDefineFunction.js"></script>
<script>
function chk_frm(){
	fm = document.agree;

	if(fm.agree1.checked == false){
		alert('이용약관에 동의 하셔야 회원가입이 가능합니다.');
		return false;
	} else if(fm.agree2.checked == false){
		alert('개인정보 보호정책에 동의하셔야 회원가입이 가능합니다.');
		return false;
	} else if(fm.Search1.value == "" || fm.Search2.value == "" || fm.Search3.value == ""){
		alert('본인 전화번호를 검색하셔야 회원가입이 가능합니다.');
		return false;
	} else if(fm.Recom[0].checked == true){
		if(fm.RPhone1.value == "" || fm.RPhone2.value == "" || fm.RPhone3.value == ""){
			alert('추천인 전화번호를 입력하셔야 회원가입이 가능합니다.');
			return false;
		}
	} else if(fm.Recom[1].checked == true){
		if(fm.RName.value == ""){
			alert('추천인 이름/닉네임을 입력하셔야 회원가입이 가능합니다.');
			return false;
		}
	} else if(fm.Recom[0].checked == false && fm.Recom[1].checked == false && fm.Recom[2].checked == false){
		alert('추천인 유형을 한가지 선택하셔야 회원가입이 가능합니다.');
		return false;
	} else {
		fm.submit();
	}
}
</script>

<form name="agree" method="post" action="join02.php" onsubmit="javascript:return chk_frm(this);">
<!-- Contents 시작 -->
<table width="668" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" align="right">
		
			<table width="450" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				  <td><img src="../img/bbs/bt01_over.jpg"></td>
				  <td><img src="../img/bbs/bt02_nor.jpg"></td>
				  <td><img src="../img/bbs/bt03_nor.jpg"></td>
			  </tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td height="140" valign="top"><img src="../img/bbs/join01_img.jpg" /></td>
	</tr>
	<tr>
		<td>
		
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="30"><img src="../img/bbs/join01_txt01.jpg"></td>
				</tr>
				<tr>
					<td bgcolor="#e7e7e7" height="1"></td>
				</tr>
				<tr>
					<td height="180" style="padding:7px;"><textarea name="join01" style="width:100%; height:160px;" id="join01" cols="45" rows="5" class="textbox_white"><? include "../board/module/incmember/mform1.php";?></textarea></td>
				</tr>
				<tr>
					<td bgcolor="#e7e7e7" height="1"></td>
				</tr>
				<tr>
					<td height="40" align="right"><input type="checkbox" name="agree1" id="radio" value="1">회원가입약관을 읽었으며 내용에 동의합니다.</td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td>
		
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="30"><img src="../img/bbs/join01_txt02.jpg"></td>
				</tr>
				<tr>
					<td bgcolor="#e7e7e7" height="1"></td>
				</tr>
				<tr>
					<td height="180" style="padding:7px;"><textarea name="join01" style="width:100%; height:160px;" id="join01" cols="45" rows="5" class="textbox_white"><? include "../board/module/incmember/mform2.php";?></textarea></td>
				</tr>
				<tr>
					<td bgcolor="#e7e7e7" height="1"></td>
				</tr>
				<tr>
					<td height="40" align="right"><input type="checkbox" name="agree2" id="radio" value="1">개인정보 취급 방침을 읽었으며 내용에 동의합니다.</td>
				</tr>
			</table>
		
		</td>
	</tr>
	
	<tr>
		<td height="40" valign="bottom"><img src="../img/bbs/join02_txt03.jpg" /></td>
	</tr>
	<tr>
		<td>
		
			<!-- 내 연락처 등록검색 시작 -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
					<td colspan="3" bgcolor="#e7e7e7" height="1"></td>
				</tr>
                <tr>
					<td width="140" height="40"><img src="../img/bbs/join02_register.jpg" /></td>
					<td>&nbsp;</td>
					<td>
                    
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="200"><input type="text" name="Search1" id="Search1"  class="textbox_nobg" maxlength="4" style="width:50px;"/> -
									<input type="text" name="Search2" id="Search2"  class="textbox_nobg" maxlength="4" style="width:50px;"/> -
									<input type="text" name="Search3" id="Search3"  class="textbox_nobg" maxlength="4" style="width:50px;"/></td>
                                <td><a href="#" onclick="javascript:RidChk('1');"><img src="../../../img/mypage/btn_search.jpg" /></a></td>
                            </tr>
                        </table>
                                    
                    </td>                   
				</tr>
				<tr>
					<td height="50"><img src="../img/bbs/join02_rec.jpg" /></td>
					<td>&nbsp;</td>
					<td>
                    
                        <table width="510" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="30" height="30" align="center"><input type="radio" name="Recom" id="Recom" value="tel"/></td>
                                <td width="80">전화번호</td>
                                <td colspan="2"><input type="text" name="RPhone1" id="RPhone1"  class="textbox_nobg" maxlength="4" style="width:50px;" onclick="document.agree.Recom[0].checked=true;"/> -
									<input type="text" name="RPhone2" id="RPhone2"  class="textbox_nobg" maxlength="4" style="width:50px;" onclick="document.agree.Recom[0].checked=true;"/> -
									<input type="text" name="RPhone3" id="RPhone3"  class="textbox_nobg" maxlength="4" style="width:50px;" onclick="document.agree.Recom[0].checked=true;"/></td>
							</tr>
							<tr>
                                <td width="30" height="30" align="center"><input type="radio" name="Recom" id="Recom" value="nick"/></td>
                                <td width="80">이름/닉네임</td>
                                <td width="150" ><input type="text" name="RName" id="RName"  class="textbox_nobg" onclick="document.agree.Recom[1].checked=true;"/></td>
								<td><a href="#" onclick="javascript:RidChk('2');"><img src="../../../img/mypage/btn_search.jpg" /></a></td>
                            </tr>
							<tr>
                                <td width="30" height="30" align="center"><input type="radio" name="Recom" id="Recom" value="no"/></td>
                                <td width="80" colspan="4">추천인없음</td>                                
                            </tr>
                        </table>
                    
					</td>
                </tr>
                <tr>
					<td colspan="3" bgcolor="#e7e7e7" height="1"></td>
				</tr>
			</table>
			<!-- 내 연락처 등록검색 끝 -->
			
		</td>
	</tr>
	<tr>
		<td height="40" align="center"><input type="image" src="../img/bbs/btn_next.jpg" />&nbsp;&nbsp;<a href="/"><img src="../img/bbs/btn_cancel.jpg" /></a></td>
	</tr>
</table>
<!-- Contents 끝 -->

</form>
<iframe name="nullframe" width="100%" height="0" frameborder="0"></iframe>
<!-- 내 연락처 등록검색 추가용 Form -->
<!-- 연락처 입력받아서 RidChk.php 파일로 보냄 -->
<form name="iform2" method="post" action="../board/module/incmember/RidChk.php" target="nullframe">
	<input type="hidden" name="Search1" value="">
	<input type="hidden" name="Search2" value="">
	<input type="hidden" name="Search3" value="">
	<input type="hidden" name="RName" value="">
	<input type="hidden" name="cat" value="">
</form>
<!-- Form End -->
<script language="javascript">
// 내 연락처 등록검색 추가 function
function RidChk(str){
	var form = document.agree;
	var f = document.iform2;
	if(str == "1"){
		if(form.Search1.value == "" || form.Search2.value == "" || form.Search3.value == ""){
			alert("전화번호를 입력하고 검색하세요");
			return false;
		} else {
			f.Search1.value = form.Search1.value;
			f.Search2.value = form.Search2.value;
			f.Search3.value = form.Search3.value;
		}
	} else {
		if(form.RName.value == ""){
			alert("이름/닉네임을 입력하고 검색하세요");
			return false;
		} else {
			f.Search1.value = form.RPhone1.value;
			f.Search2.value = form.RPhone2.value;
			f.Search3.value = form.RPhone3.value;
			f.RName.value = form.RName.value;
		}
	}
	f.cat.value = str;
	f.submit();
}
//RidChk.php 에서 닉네임과 핸드폰번호 가져와서 내 연락처 등록검색 필드에 쏴주기
function chkRidMsg(msg,nick,phone) {
	var form = document.agree;
	alert(msg);
	if(nick != "" && phone != ""){
		form.RName.value = nick;
		var rphone = phone.split("-");
		var rphone1 = rphone[0];
		var rphone2 = rphone[1];
		var rphone3 = rphone[2];
		form.RPhone1.value = rphone1;
		form.RPhone2.value = rphone2;
		form.RPhone3.value = rphone3;
	} else if(nick != "" && phone == ""){
		form.RName.value = nick;
	}
}
// function end

</script>