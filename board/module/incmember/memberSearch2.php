<?
$UserID = $_REQUEST[UserID];
$UserName = $_REQUEST[UserName];
$Jumin1 = $_REQUEST[Jumin1];
$Jumin2 = $_REQUEST[Jumin2];

$psql = " select password('".$Jumin2."') ";
$presult = mysql_query($psql);
$prow = mysql_fetch_array($presult);

$sql = " select * from ".$memberdb." where 1 ";

if($UserID) $sql .= " AND UserID = '".$UserID."' ";
if($UserName && $Jumin1 && $Jumin2) $sql .= " AND UserName = '".$UserName."' AND JuminNo = '".$Jumin1."-".$prow[0]."' ";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);

if(!$row[UserID]) err_back("not exists.");
//echo $sql;

?>
<form name="pwFind" method="post" action="popup_idpw_search3.php" onsubmit="Findpw(this);">
<input type="hidden" name="UserID" value="<?=$row[UserID]?>">
<table width="420" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" style="background:url(../images/membership/popup_top.gif) repeat-x; height:80px; padding-top:10px; padding-left:10px"><img src="../images/membership/popup_idpw_title.gif" width="246" height="33"></td>
	</tr>
	<tr>
		<td align="center">
			<table width="340" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td style="background:url(../images/membership/popup_box_top.gif) no-repeat; width:340px; height:5px;"></td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_bg.gif) repeat-y; width:340px; text-align:center; padding-top:10px; padding-bottom:10px">
					
						<!-- 아이디/패스워드 찾기 Start -->
						<table width="300" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="130" height="40"><img src="../images/membership/popup_t_id.gif" width="66" height="12"></td>
								<td><strong><?=$row[UserID]?></td>
							</tr>
							<tr>
								<td width="130" height="40"><img src="../images/membership/popup_t_pw1.gif" width="111" height="12"></td>
								<td><?=$row[mem_question]?></td>
							</tr>
							<tr>
								<td width="130" height="40"><img src="../images/membership/popup_t_pw2.gif" width="110" height="12"></td>
								<td><input name="mem_answer" type="text" class="input_box" style="width:150px;"/></td>
							</tr>
							
						</table>
						<!-- 아이디/패스워드 찾기 End -->
											
					</td>
				</tr>
				<tr>
					<td style="background:url(../images/membership/popup_box_bot.gif) no-repeat; width:340px; height:10px;"></td>
				</tr>
				<tr>
					<td height="40" align="center"><input type="image" src="../images/membership/btn_next.gif" alt="다음" width="54" height="22"></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right" valign="bottom" style="background:url(../images/membership/popup_bot.gif) no-repeat right;height:50px; padding-right:10px; padding-bottom:6px"><a href="javascript:parent.close()"><img src="../images/membership/btn_close.gif" alt="close" width="39" height="8"></a></td>
	</tr>
</table>
</form>
<script>
function Findpw(form){
	if(form.mem_answer.value == "" || form.mem_answer.value == null){
		alert("Password Forget Answer Input.");
		form.mem_answer.focus();
		return false;
	}

	return true;
}
</script>