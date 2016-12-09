<?
$mem_answer = $_REQUEST[mem_answer];
$UserID = $_REQUEST[UserID];

$fsql = " select * from ".$memberdb." where 1 AND UserID = '".$UserID."' ";
$fresult = mysql_query($fsql);
$frow = mysql_fetch_array($fresult);

if($frow[mem_answer] == $mem_answer){
	$npw = rand(111111,999999);
	$usql = " update ".$memberdb." set Password = password('".$npw."') where UserID = '".$UserID."' ";
	$uresult = mysql_query($usql);
	if(!$uresult){
		err_back("Password Change Error");
	}
} else {
	err_back("Wrong Answer");
}

?>
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
								<td width="130" height="20"><img src="../images/membership/popup_t_id.gif" width="66" height="12"></td>
								<td width="270"><strong><?=$UserID?></strong></td>
							</tr>
							<tr>
								<td height="20"><img src="../images/membership/popup_t_pw3.gif" width="87" height="12"></td>
								<td><strong><?=$npw?></strong></td>
							</tr>
							<tr>
								<td height="30" colspan="2" class="font_s_bl">* 새로 부여된 패스워드는 로그인 후 변경해 주세요.</td>
							</tr>
						</table>	
						<!-- 아이디/패스워드 찾기 End -->
										
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
