<?
	$q = "select * from ".$memberdb." where UserID ='".$user['ID']."' ";
	$rs = mysql_query($q);
	$row = mysql_fetch_assoc($rs);
	$Email = explode("@",$row[Email]);
	$ZipCode = explode("-",$row[ZipCode]);
	$Phone = explode("-",$row[Phone]);
	$Mobile = explode("-",$row[Mobile]);
?>

	<table width="560" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="../images/bbs/secede_img.jpg"></td>
		</tr>
<form name="loginForm" method="post" action="../module/incmember/memberBreak_ok.php" onsubmit="return chk_frm();">
	  <input type=hidden name="UserID" value="<?=$userID?>">
	  <input type=hidden name="UserName" value="<?=$userNAME?>">
	  <input type=hidden name="UserIdx" value="<?=$userIdx?>">
		<tr>
			<td height="130" align="center">
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="3" height="2" bgcolor="#19aab9"></td>
					</tr>
					<tr>
						<td colspan="3" height="1" bgcolor="#e7e7e7"></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td height="30"><img src="../images/bbs/join02_pw.jpg" /></td>
						<td>&nbsp;</td>
						<td><input name="Password1" type="password" maxlength="10" TABINDEX="12" style="width:150px;"></td>
					</tr>
					<tr>
						<td><img src="../images/bbs/join02_mail.jpg"/></td>
						<td>&nbsp;</td>
						<td><input name="Email" type="text" maxlength="10" TABINDEX="12" style="width:250px;"></td>  
					</tr>
					<tr>
						<td></td>
						<td>&nbsp;</td>
						<td><b>이용하시면서 불편하셨던 사항을 체크해 주세요.(중복체크가능)</b></td>  
					</tr>
					<tr>
						<td></td>
						<td>&nbsp;</td>
						<td><input type="checkbox" value="개인정보 유출우려" name="reason1" /> 개인정보 유출우려</td>  
					</tr>
					<tr>
						<td></td>
						<td>&nbsp;</td>
						<td><input type="checkbox" value="자주 이용하지 않음" name="reason2" /> 자주 이용하지 않음</td>  
					</tr>
					<tr>
						<td></td>
						<td>&nbsp;</td>
						<td><input type="checkbox" value="기타" name="reason4" /> 기타</td>  
					</tr>
					<tr>
						<td></td>
						<td>&nbsp;</td>
						<td><textarea name="note" rows="5" cols="80"></textarea></td>  
					</tr>
					<tr>
						<td></td>
						<td>&nbsp;</td>
						<td></td>  
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3" height="1" bgcolor="#e7e7e7"></td>
					</tr>
					<tr>
						<td colspan="3" height="2" bgcolor="#19aab9"></td>
					</tr>
				</table>
			
			</td>
		</tr>
		<tr>
			<td height="40" align="center" valign="bottom"><input type="image" src="../images/bbs/btn_secede.jpg"></td>
		</tr>
		</form>
	</table>


<script>
	function chk_frm(){
		var fm = document.loginForm;
		if(fm.Password1.value==''){
			alert('비밀번호를 입력하세요');
			fm.Password1.focus();
		  return false;
		}else{
			fm.submit();
		}
	}
</script>
			</td>
	  </tr>
	</table>
</form>