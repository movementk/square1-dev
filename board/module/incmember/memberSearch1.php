<? if($user[ID]) err_back("Already Login."); ?>
<table width="420" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" style="background:url(../images/membership/popup_top.gif) repeat-x; height:80px; padding-top:10px; padding-left:10px"><img src="../images/membership/popup_idpw_title.gif" width="246" height="33"></td>
	</tr>
	<tr>
		<td align="center">
			<table width="340" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="20" valign="top"><img src="../images/membership/popup_idpw_t1.gif" width="128" height="11"></td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_top.gif) no-repeat; width:340px; height:5px;"></td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_bg.gif) repeat-y; width:340px; text-align:center; padding-top:10px; padding-bottom:10px">
					<form name="idFind" method="post" action="popup_idpw_search2.php" onsubmit="return findchk(this);">
						<!-- 아이디/패스워드 찾기 Start -->
						<table width="300" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="130"><img src="../images/membership/popup_t_id.gif" width="66" height="12"></td>
								<td><input type="text" name="UserID" id="UserID" class="input_box" style="width:150px"></td>
							</tr>
							<tr>
								<td colspan="2" align="center" style="padding-top:10px;"><input type="image" src="../images/membership/btn_next.gif" alt="다음" width="54" height="22"></td>
							</tr>
						</table>
						<!-- 아이디/패스워드 찾기 End -->
					</form>						
					</td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_bot.gif) no-repeat; width:340px; height:10px;"></td>
				</tr>
				<tr>
					<td height="20"></td>
				</tr>
				<tr>
					<td height="20" valign="top"><img src="../images/membership/popup_idpw_t2.gif" width="142" height="11"></td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_top.gif) no-repeat; width:340px; height:5px;"></td>
				</tr>
				
				<tr>
					<td style="background:url(../images/membership/popup_box_bg.gif) repeat-y; width:340px; text-align:center; padding-top:10px; padding-bottom:10px">
					<form name="juminFind" method="post" action="popup_idpw_search2.php" onsubmit="return findchk(this);">
						<!-- 아이디/패스워드 찾기 Start -->
						<table width="300" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="130"><img src="../images/membership/popup_t_name.gif" width="32" height="12"></td>
								<td><input type="text" name="UserName" id="UserName" class="input_box" style="width:150px"></td>
							</tr>
							<tr>
								<td width="130"><img src="../images/membership/join_t_jumin.gif"></td>
								<td><input name="Jumin1" type="text" class="input_box" style="width:68px;"/> - <input name="Jumin2" type="text" class="input_box"  style="width:68px;"/></td>
							</tr>
							<tr>
								<td colspan="2" align="center" style="padding-top:10px;"><input type="image" src="../images/membership/btn_next.gif" alt="다음" width="54" height="22"></td>
							</tr>
						</table>
						<!-- 아이디/패스워드 찾기 End -->
					</form>						
					</td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_bot.gif) no-repeat; width:340px; height:10px;"></td>
				</tr>
				
			</table>
		</td>
	</tr>
	<tr>
		<td align="right" valign="bottom" style="background:url(../images/membership/popup_bot.gif) no-repeat right;height:50px; padding-right:10px; padding-bottom:6px"><a href="javascript:parent.close()"><img src="../images/membership/btn_close.gif" alt="close" width="39" height="8"></a></td>
	</tr>
</table>

<script>
function findchk(form){
	if(form.name == "juminFind"){
		if(form.UserName.value == "" || form.UserName.value == null){
			alert("Please Input Name.");
			form.UserName.focus();
			return false;
		}

		if(form.Jumin1.value == "" || form.Jumin1.value == null || form.Jumin2.value == "" || form.Jumin2.value == null){
			alert("Enter your social security number.");
			form.Jumin1.focus();
			return false;
		}

	} else if(form.name == "idFind"){
		if(form.UserID.value == "" || form.UserID.value == null){
			alert("Please Input ID");
			form.UserID.focus();
			return false;
		}
	}
	return true;
}
</script>