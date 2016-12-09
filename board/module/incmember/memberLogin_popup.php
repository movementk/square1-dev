<?
include "../../../config/use_db.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../common/css/common.css" rel="stylesheet" type="text/css">
<link href="../common/css/style_blue.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../common/script/flash.js"></script>
<script type="text/javascript" src="../common/script/flash_link.js"></script>
</head>
<body>
<script type="text/javascript">
<!--
function check_login() {
	var f=document.loginForm;
	if(f.UserID.value==""){
		  alert("아이디를 입력해주세요!");
		  f.UserID.focus();
		  return false;
	}else if(f.Password1.value==""){
		  alert("비밀번호를 입력해주세요!");
		  f.Password1.focus();
		  return false;
	}else{
		f.submit();
	}
}
//-->
</script>

<!-- 로그인 들어가는 곳 시작 -->
<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="../images/bbs/login_box_top.jpg"></td>
	</tr>
	<tr>
		<td background="../images/bbs/login_box_bg.jpg" style="background-repeat:repeat-y" class="pl40"><img src="../images/bbs/login_img.jpg"></td>
	</tr>
	<tr>
		<td height="35" background="../images/bbs/login_box_bg.jpg" class="pl40" style="background-repeat:repeat-y">
			<table width="520" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="20"><input type="radio" name="memberType" id="radio" value="c" /></td>
					<td width="50">사업자</td>
					<td width="20"><input type="radio" name="memberType" id="radio2" value="p" /></td>
					<td>개인회원</td>
				</tr>
			</table>
			
		</td>
	</tr>
	<tr>
		<td align="center" background="../images/bbs/login_box_bg.jpg" style="background-repeat:repeat-y">
		
			<!-- ID,PW들어가는 곳 시작 -->
			<table width="520" border="0" cellspacing="0" cellpadding="0">
				<form name="loginForm" method="post" action="../module/incmember/login_ok.php" onsubmit="return check_login();">
				<tr>
					<td><img src="../images/bbs/login_box2_top.jpg"></td>
				</tr>
				<tr>
					<td height="40" align="center" background="../images/bbs/login_box2_bg.jpg">
					
						<table width="500" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="../images/bbs/login_txt01.jpg"></td>
								<td><input name="UserID" type="text" maxlength="15" TABINDEX="11"  style="IME-MODE: disabled;"  class="input_box" size="20" checked></td>
								<td><img src="../images/bbs/login_txt02.jpg"></td>
								<td><input name="Password1" type="password" maxlength="15" TABINDEX="12" style="IME-MODE: disabled;"  class="input_box" size="20"></td>
								<td><input type="image" src="../images/bbs/btn_login.jpg"></td>
							</tr>
						</table>
					
					</td>
				</tr>
				<tr>
					<td><img src="../images/bbs/login_box2_bottom.jpg"></td>
				</tr>
				</form>
			</table>
			<!-- ID,PW들어가는 곳 끝 -->
		
		</td>
	</tr>
	<tr>
		<td height="50" background="../images/bbs/login_box_bg.jpg" class="pl40" style="background-repeat:repeat-y">
			<table width="520" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" width="15"><b>·</b></td>
					<td>아이디 및 비밀번호는 영문 대소문자를 구별하니 입력 시 주의하시기 바랍니다.</td>
				</tr>
				<tr>
					<td align="center"><b>·</b></td>
					<td>비밀번호 입력 3회 이상 오류 시 본인확인을 거친 후 비밀번호를 변경하셔야 합니다.</td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td height="30" align="center" background="../images/bbs/login_box_bg.jpg" style="background-repeat:repeat-y"><a href="idpw_search.php"><img src="../images/bbs/btn_find.jpg"></a>&nbsp;&nbsp;<a href="join_agree.php"><img src="../images/bbs/btn_join.jpg"></a></td>
	</tr>
	<tr>
		<td><img src="../images/bbs/login_box_bottom.jpg"></td>
	</tr>
</table>
<!-- 로그인 들어가는 곳 끝 -->
</body>

</html>

